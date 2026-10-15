<?php
/**
 * register_user_form.php
 * Displays the registration form.
 * Users enter a username, password, and email here;
 * the form POSTs to register_user.php, which creates the account.
 */

declare(strict_types=1);
// ↑ Enforces strict type checking in PHP 8+.
//   Every file in this project starts with this.

require('functions.php');
// ↑ Loads the e() helper, used below to safely escape output.

if (session_status() === PHP_SESSION_NONE) {
    // ↑ Only start the session if one isn't already active.
    //   Prevents a "session already started" warning if this file
    //   is ever included after another file has already started one.
    //   I need the session so I can display a "user_error" message
    //   left over from a failed registration attempt.
    session_start();
}

$pageTitle = 'Register User';
// ↑ header.php reads this variable to set the browser tab title.

require('header.php');
// ↑ Outputs <!DOCTYPE html>, <head>, <body>, and the header banner.
?>

<main>
    <h2>Register User</h2>

    <?php if (isset($_SESSION['user_error'])): ?>
        <?php // ↑ Flash-message pattern: if a previous page stored an error
              //   in the session, show it now, then clear it so a page
              //   refresh doesn't display it again. ?>
        <p class="error"><?= e($_SESSION['user_error']) ?></p>
        <?php unset($_SESSION['user_error']); ?>
    <?php endif; ?>

    <form action="register_user.php" method="post" id="register_user_form">
        <?php // ↑ action: the URL that will receive the form data on submit.
              //   method="post": sends data in the request body (never GET —
              //   credentials must not appear in the URL or browser history). ?>

        <div id="data">
            <label>Username:</label>
            <input type="text" name="user_name"><br>
            <?php // ↑ name="user_name" means the value arrives in
                  //   register_user.php as $_POST['user_name']. ?>

            <label>Password:</label>
            <input type="password" name="password"><br>
            <?php // ↑ type="password" masks characters as the user types.
                  //   Sent as $_POST['password']. Never shown in plain text. ?>

            <label>Email Address:</label>
            <input type="text" name="email_address"><br>
            <?php // ↑ Sent as $_POST['email_address'].
                  //   We use type="text" (not type="email") to match the
                  //   project's pattern — validation happens in PHP. ?>
        </div>

        <div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" value="Register"><br>
            <?php // ↑ The &nbsp; keeps the label column aligned (matches
                  //   the layout of other forms in this project).
                  //   Clicking this POSTs all three fields above. ?>
        </div>
    </form>

    <p><a href="login_form.php">View Login</a></p>
    <?php // ↑ Fallback link for users who already have an account. ?>
</main>

<?php require('footer.php'); ?>