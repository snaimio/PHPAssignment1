<?php
/**
 * update_book_confirmation.php
 * Shown after a book is successfully updated.
 */

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require('functions.php');

// Read once, then clear
$updated_title = $_SESSION['updated_title'] ?? 'the book';
unset($_SESSION['updated_title']);

$pageTitle = 'Book Updated';

require('header.php');
?>

<main>
    <h2>Book Updated</h2>

    <p>
        Thank you! <strong><?= e($updated_title) ?></strong> has been updated.
    </p>

    <p><a href="index.php">View Book List</a></p>
</main>

<?php require('footer.php'); ?>