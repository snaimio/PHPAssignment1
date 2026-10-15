<?php
/**
 * login_form.php
 * Displays the login form. Users enter a username and password here;
 * the form POSTs to login.php, which verifies the credentials.
 */

declare(strict_types=1);
// ↑ Enforces strict type checking.

require('functions.php');
// ↑ Gives me the e() helper for safe HTML output.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    // ↑ I need the session so I can show any error message
    //   left over from a failed login attempt.
}

$pageTitle = 'Login';

require('header.php');
?>

<main>
    <h2>Login</h2>

    <?php if (isset($_SESSION['login_error'])): ?>
        <?php
        // Flash-message pattern: if a previous page stored an error
        // in the session, show it now, then clear it so a page
        // refresh doesn't display it again.
        //
        // If the error contains a number followed by "second",
        // I wrap that number in a <span id="countdown"> so the
        // JavaScript below can find it and tick it down each second.
        $errorMessage = $_SESSION['login_error'];
        $errorHtml = e($errorMessage);

        if (preg_match('/(\d+)\s+second/i', $errorMessage, $matches)) {
            // Replace just the number with a span so the JS can target it.
            $errorHtml = preg_replace(
                '/(\d+)(\s+second)/i',
                '<span id="countdown">$1</span>$2',
                $errorHtml
            );
        }
        ?>
        <p class="error"><?= $errorHtml ?></p>
        <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>

    <script src="js/login_countdown.js"></script>

    <form action="login.php" method="post" id="login_form">
        <?php // ↑ action: the handler that will verify credentials.
              //   method="post": credentials never go in the URL. ?>

        <div id="data">
            <label>Username:</label>
            <input type="text" name="user_name"><br>

            <label>Password:</label>
            <input type="password" name="password"><br>
            <?php // ↑ type="password" masks the input as dots. ?>
        </div>

        <div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" value="Login"><br>
        </div>
    </form>

    <p><a href="register_user_form.php">Register</a></p>
    <?php // ↑ Link for users who don't have an account yet. ?>
</main>

<?php require('footer.php'); ?>