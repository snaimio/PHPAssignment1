<?php
/**
 * add_error.php
 * Friendly error page shown when an Add Book submission fails validation.
 */

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require('functions.php');

$errorMessage = $_SESSION['add_error'] ?? 'Unknown error.';
unset($_SESSION['add_error']);

$pageTitle = 'Add Error';

require('header.php');
?>

<main>
    <h2>Add Book Error</h2>

    <p><strong>Message:</strong> <?= e($errorMessage) ?></p>

    <p><a href="add_book_form.php">Try Again</a></p>
    <p><a href="index.php">View Book List</a></p>
</main>

<?php require('footer.php'); ?>