<?php
/**
 * login.php
 * Handles the login form submission.
 * Verifies the username and password, enforces account lockout
 * after 3 failed attempts, and starts the session on success.
 */

declare(strict_types=1);
// ↑ Enforces strict type checking.

session_start();
// ↑ I need the session to track logged-in state and error messages.

// ---------------------------------------------------------------
// 1. Read form data
// ---------------------------------------------------------------
$user_name     = filter_input(INPUT_POST, 'user_name');
$user_password = filter_input(INPUT_POST, 'password');
// ↑ filter_input() reads POST values safely and returns null
//   if the field is missing.

// ---------------------------------------------------------------
// 2. Validate non-empty
// ---------------------------------------------------------------
if ($user_name === null || $user_name === '' ||
    $user_password === null || $user_password === '') {

    $_SESSION['login_error'] = 'Please enter both username and password.';
    header('Location: login_form.php');
    die();
    // ↑ Redirect back to the form instead of a separate error page —
    //   login errors should feel immediate and inline.
}

// ---------------------------------------------------------------
// 3. Connect to the database
// ---------------------------------------------------------------
require_once('database.php');

// ---------------------------------------------------------------
// 4. Look up the user by username
// ---------------------------------------------------------------
$queryUsers = 'SELECT * FROM registrations WHERE userName = :userName';
$statement = $db->prepare($queryUsers);
$statement->bindValue(':userName', $user_name);
$statement->execute();
$user = $statement->fetch();
$statement->closeCursor();
// ↑ fetch() returns one row (associative array) or false.

if (!$user) {
    // ↑ The username doesn't exist.
    //   I use a generic message so attackers can't enumerate valid usernames.
    $_SESSION['login_error'] = 'Invalid username or password.';
    header('Location: login_form.php');
    die();
}

// ---------------------------------------------------------------
// 5. Check lockout status
// ---------------------------------------------------------------
if ($user['failedAttempts'] >= 3 && $user['lastFailedLogin'] !== null) {
    // ↑ The account is locked if:
    //   - failedAttempts has reached 3, AND
    //   - there's an actual last-failure timestamp to measure against.

    // I ask MySQL to compute the seconds elapsed between the last
    // failure and the current time. Both timestamps come from MySQL,
    // so there's no PHP-vs-MySQL timezone mismatch possible.
    $querySeconds = 'SELECT TIMESTAMPDIFF(SECOND, lastFailedLogin, NOW()) AS seconds_since
                     FROM registrations
                     WHERE userName = :userName';
    $statement = $db->prepare($querySeconds);
    $statement->bindValue(':userName', $user_name);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();

    $interval = (int) $row['seconds_since'];
    // ↑ Seconds since the last failed attempt, per MySQL.

    if ($interval < 300) {
        // ↑ Still within the 5-minute (300 second) lockout window.

        $remaining = 300 - $interval;
        $_SESSION['login_error'] = 'Account locked. Try again in ' . $remaining . ' second(s).';
        header('Location: login_form.php');
        die();
    }
    // ↑ If the lockout has expired, execution falls through to the
    //   password check below.
}

// ---------------------------------------------------------------
// 6. Verify the password
// ---------------------------------------------------------------
if (password_verify($user_password, $user['password'])) {
    // ↑ password_verify() hashes the input with the stored salt
    //   and compares. If they match, the password is correct.

    // -----------------------------------------------------------
    // 6a. Successful login — reset the failure counter
    // -----------------------------------------------------------
    $query = 'UPDATE registrations
              SET failedAttempts = 0,
                  lastFailedLogin = NULL
              WHERE userName = :userName';
    $statement = $db->prepare($query);
    $statement->bindValue(':userName', $user_name);
    $statement->execute();
    $statement->closeCursor();
    // ↑ Without this reset, a user who succeeded after 2 fails would
    //   still be 1 fail away from lockout.

    // -----------------------------------------------------------
    // 6b. Set session variables
    // -----------------------------------------------------------
    $_SESSION['isLoggedIn'] = true;
    $_SESSION['userName']   = $user['userName'];
    $_SESSION['userID']     = (int) $user['userID'];
    // ↑ Same three keys used in register_user.php.

    header('Location: login_confirmation.php');
    die();
}

// ---------------------------------------------------------------
// 7. Wrong password — increment failure counter
// ---------------------------------------------------------------
$query = 'UPDATE registrations
          SET failedAttempts = COALESCE(failedAttempts, 0) + 1,
              lastFailedLogin = NOW()
          WHERE userName = :userName';
$statement = $db->prepare($query);
$statement->bindValue(':userName', $user_name);
$statement->execute();
$statement->closeCursor();
// ↑ COALESCE handles the case where failedAttempts is NULL
//   (shouldn't happen given DEFAULT 0, but it's a safe guard).
//   I use MySQL's NOW() here, so both the timestamp and the later
//   comparison in Section 5 come from the same source.

// ---------------------------------------------------------------
// 8. Show the right error message
// ---------------------------------------------------------------
$query = 'SELECT failedAttempts FROM registrations WHERE userName = :userName';
$statement = $db->prepare($query);
$statement->bindValue(':userName', $user_name);
$statement->execute();
$updatedUser = $statement->fetch();
$statement->closeCursor();

if ($updatedUser['failedAttempts'] >= 3) {
    // ↑ I just hit the lockout threshold on this attempt.
    $_SESSION['login_error'] = 'Account locked. Try again in 300 second(s).';
} else {
    $_SESSION['login_error'] = 'Invalid username or password.';
}
// ↑ Note: I reuse the generic message here too, so a wrong password
//   on a real username looks identical to a wrong username.

header('Location: login_form.php');
die();