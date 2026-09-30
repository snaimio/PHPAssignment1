<?php
/**
 * add_book.php
 * Handles the Add Book form submission.
 * Validates input, then INSERTs a new book into the database.
 * On success, redirects to a confirmation page.
 * On failure, redirects to add_error.php with a message.
 */

declare(strict_types=1);

session_start();

// Get form data
$title          = filter_input(INPUT_POST, 'title');
$author         = filter_input(INPUT_POST, 'author');
$genre          = filter_input(INPUT_POST, 'genre');
$isbn           = filter_input(INPUT_POST, 'isbn');
$published_date = filter_input(INPUT_POST, 'published_date');
$format_id      = filter_input(INPUT_POST, 'format_id', FILTER_VALIDATE_INT);

require_once('database.php');

// ----- Validation -----

// Check for empty fields
if ($title === null || $title === '' ||
    $author === null || $author === '' ||
    $genre === null || $genre === '' ||
    $isbn === null || $isbn === '' ||
    $published_date === null || $published_date === '' ||
    $format_id === null || $format_id === false) {

    $_SESSION['add_error'] = 'Invalid book data. Please fill in all fields and try again.';
    header('Location: add_error.php');
    die();
}

// Check for duplicate ISBN
$queryCheck = 'SELECT bookID FROM books WHERE isbn = :isbn';
$statement = $db->prepare($queryCheck);
$statement->bindValue(':isbn', $isbn);
$statement->execute();
$existing = $statement->fetch();
$statement->closeCursor();

if ($existing) {
    $_SESSION['add_error'] = 'A book with that ISBN already exists. Please check the ISBN and try again.';
    header('Location: add_error.php');
    die();
}

// ----- Insert the new book -----

$query = 'INSERT INTO books (title, author, genre, isbn, publishedDate, formatID)
          VALUES (:title, :author, :genre, :isbn, :publishedDate, :formatID)';

$statement = $db->prepare($query);
$statement->bindValue(':title', $title);
$statement->bindValue(':author', $author);
$statement->bindValue(':genre', $genre);
$statement->bindValue(':isbn', $isbn);
$statement->bindValue(':publishedDate', $published_date);
$statement->bindValue(':formatID', $format_id);
$statement->execute();
$statement->closeCursor();

// Store a message for the confirmation page
$_SESSION['added_title'] = $title;

header('Location: add_book_confirmation.php');
die();