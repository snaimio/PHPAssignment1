<?php
/**
 * add_book_confirmation.php
 * Shown after a book is successfully added.
 */

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require('functions.php');

// Read once, then clear
$added_title = $_SESSION['added_title'] ?? 'the book';
unset($_SESSION['added_title']);

$pageTitle = 'Book Added';

require('header.php');
?>

<main>
    <h2>Book Added</h2>

    <p>
        Thank you! <strong><?= e($added_title) ?></strong> has been added to your library.
    </p>

    <p><a href="index.php">View Book List</a></p>
    <p><a href="add_book_form.php">Add Another Book</a></p>
</main>

<?php require('footer.php'); ?>