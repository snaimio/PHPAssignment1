<?php
/**
 * user_error.php
 * Friendly error page for registration or login failures.
 * Reads the flash message from the session and displays it once.
 */

declare(strict_types=1);

require('functions.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    // ↑ I need the session here because the error message was stored
    //   in $_SESSION['user_error'] by the previous page.
}

$errorMessage = $_SESSION['user_error'] ?? 'Unknown error.';
// ↑ Read the message, with a fallback if the session key is missing.

unset($_SESSION['user_error']);
// ↑ Clear the message so a page refresh doesn't show it again.

$pageTitle = 'User Error';

require('header.php');
?>

<main>
    <h2>Registration Error</h2>

    <p><strong>Message:</strong> <?= e($errorMessage) ?></p>
    <?php // ↑ e() escapes special characters to prevent XSS. ?>

    <p><a href="register_user_form.php">Try Again</a></p>
    <p><a href="login_form.php">Go to Login</a></p>
    <?php // ↑ Give the user two ways forward after an error. ?>
</main>

<?php require('footer.php'); ?>