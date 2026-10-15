<?php
/**
 * register_user_confirmation.php
 * Success page shown right after a user registers.
 * Reads the username from the session and displays a thank-you message.
 */

declare(strict_types=1);
// ↑ Enforces strict type checking. I use this in every file.

require('functions.php');
// ↑ Gives me the e() helper for safe HTML output.

if (session_status() === PHP_SESSION_NONE) {
    // ↑ Only start a session if one isn't already active.
    //   Prevents a warning if a session was already started elsewhere.
    session_start();
}

$userName = $_SESSION['userName'] ?? 'User';
// ↑ Read the username I stored in the session when the user registered.
//   The ?? 'User' is a fallback in case the session is missing.

$pageTitle = 'Registration Complete';
// ↑ header.php reads this to set the browser tab title.

require('header.php');
// ↑ Prints the top half of the page (doctype, head, header banner).
?>

<main>
    <h2>Registration Complete</h2>

    <p>
        Thank you, <strong><?= e($userName) ?></strong>, for registering.
        You are now logged in and ready to use the Book Library.
    </p>
    <?php // ↑ e() escapes special characters to prevent XSS. ?>

    <p><a href="index.php">Go to Book List</a></p>
    <p><a href="logout.php">Log Out</a></p>
</main>

<?php require('footer.php'); ?>
<?php // ↑ Prints the bottom half of the page (footer, closing tags). ?>