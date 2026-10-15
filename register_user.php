<?php
/**
 * register_user.php
 * Handles the registration form submission.
 * Validates input, checks for a duplicate username, hashes the password,
 * inserts the new user, sets session variables, and redirects to the
 * confirmation page.
 */

declare(strict_types=1);
// ↑ Enforces strict type checking in PHP 8+.
//   I include this in every file so type mismatches throw errors
//   instead of silently coercing values.

session_start();
// ↑ Start (or resume) the session so I can write flash messages
//   and set the login flags after the user registers.
//   Must be called before any output is sent to the browser.

// ---------------------------------------------------------------
// 1. Read form data using filter_input()
// ---------------------------------------------------------------
$user_name     = filter_input(INPUT_POST, 'user_name');
$user_password = filter_input(INPUT_POST, 'password');
$email_address = filter_input(INPUT_POST, 'email_address');
// ↑ filter_input() reads a POST field safely.
//   It returns null if the field is missing, which makes the
//   validation step below straightforward.

// ---------------------------------------------------------------
// 2. Validate that all fields are non-empty
// ---------------------------------------------------------------
if ($user_name === null || $user_name === '' ||
    $user_password === null || $user_password === '' ||
    $email_address === null || $email_address === '') {

    // ↑ If any field is missing or empty, I bail out.
    //   I check for both null (field not sent) and '' (blank value).
    //   I use === (strict) instead of == to avoid type coercion surprises.

    $_SESSION['user_error'] = 'Please fill in all fields and try again.';
    // ↑ Flash message: user_error.php will read this and display it.

    header('Location: user_error.php');
    // ↑ Send the browser to the error page.

    die();
    // ↑ Stop execution. Without this, PHP would keep running the
    //   rest of the file and try to insert a bad row.
}

// ---------------------------------------------------------------
// 3. Connect to the database
// ---------------------------------------------------------------
require_once('database.php');
// ↑ Loads the PDO connection and assigns it to $db.
//   I place this after validation so I don't open a connection
//   just to reject an empty form.

// ---------------------------------------------------------------
// 4. Check for duplicate username
// ---------------------------------------------------------------
$queryCheck = 'SELECT userID FROM registrations WHERE userName = :userName';
// ↑ I only need userID — not the whole row.
//   MySQL fetches the smallest possible result this way.

$statement = $db->prepare($queryCheck);
// ↑ Prepare the query shape before binding values.

$statement->bindValue(':userName', $user_name);
// ↑ Attach the actual value to the placeholder. This is what
//   prevents SQL injection — the value never becomes part of
//   the SQL string itself.

$statement->execute();
// ↑ Run the query.

$existing = $statement->fetch();
// ↑ fetch() returns one row as an associative array, or false
//   if no match was found.

$statement->closeCursor();
// ↑ Free the result set so the connection is ready for the next query.

if ($existing) {
    // ↑ If fetch() returned a row, the username is taken.
    //   (false is falsy, so the if block is skipped when no match.)

    $_SESSION['user_error'] = 'That username is already taken. Please choose a different one.';
    header('Location: user_error.php');
    die();
    // ↑ Same redirect pattern as before — set message, redirect, stop.
    //   The DB also has a UNIQUE constraint on userName as a backup,
    //   but this PHP check gives the user a friendlier error.
}

// ---------------------------------------------------------------
// 5. Hash the password
// ---------------------------------------------------------------
$hash = password_hash($user_password, PASSWORD_DEFAULT);
// ↑ One-way hash of the password. PASSWORD_DEFAULT tells PHP to use
//   its current recommended algorithm (bcrypt now, may change later).
//   I never store the plain password — only this hash.

// ---------------------------------------------------------------
// 6. Insert the new user
// ---------------------------------------------------------------
$query = 'INSERT INTO registrations (userName, password, emailAddress)
          VALUES (:userName, :password, :emailAddress)';
// ↑ Note the string closes with ' before the ;.
//   I'm inserting only the three columns I have values for.
//   userID, failedAttempts, and lastFailedLogin are filled in by
//   MySQL's AUTO_INCREMENT and DEFAULT settings.

$statement = $db->prepare($query);
$statement->bindValue(':userName', $user_name);
$statement->bindValue(':password', $hash);
// ↑ Critical: I bind $hash here, NOT $user_password.
//   Binding the plain password would defeat the point of hashing.
$statement->bindValue(':emailAddress', $email_address);
$statement->execute();
// ↑ If the INSERT fails (e.g., a race condition where another user
//   registered the same name a millisecond ago), PDO will throw an
//   exception because ERRMODE_EXCEPTION is set in database.php.
$statement->closeCursor();

// ---------------------------------------------------------------
// 7. Set session variables
// ---------------------------------------------------------------
$_SESSION['isLoggedIn'] = true;
// ↑ The "gate" flag. Every protected page checks this to decide
//   whether to grant access.

$_SESSION['userName'] = $user_name;
// ↑ Used for displaying "Welcome, X" on pages and headers.

$_SESSION['userID'] = (int) $db->lastInsertId();
// ↑ lastInsertId() returns the auto-assigned userID as a string.
//   I cast to int because strict_types is on and I want a real
//   integer for any future comparisons or queries.

// ---------------------------------------------------------------
// 8. Redirect to confirmation page
// ---------------------------------------------------------------
header('Location: register_user_confirmation.php');
// ↑ Send the browser to the success page.
//   Because I used a redirect (not a require), the user's browser
//   will GET the confirmation page — safe to refresh, no re-POST.

die();
// ↑ Stop execution. header() alone doesn't end the script.