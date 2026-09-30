<?php
/**
 * update_book.php
 * Handles the Update Book form submission.
 * Validates input, then UPDATEs the book in the database.
 */

declare(strict_types=1);

session_start();

// Get form data
$book_id        = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
$title          = filter_input(INPUT_POST, 'title');
$author         = filter_input(INPUT_POST, 'author');
$genre          = filter_input(INPUT_POST, 'genre');
$isbn           = filter_input(INPUT_POST, 'isbn');
$published_date = filter_input(INPUT_POST, 'published_date');
$format_id      = filter_input(INPUT_POST, 'format_id', FILTER_VALIDATE_INT);

require_once('database.php');

// ----- Validation -----

// Check the book ID
if ($book_id === null || $book_id === false) {
    $_SESSION['update_error'] = 'Invalid book reference. Please try again.';
    header('Location: update_error.php');
    die();
}

// Check for empty fields
if ($title === null || $title === '' ||
    $author === null || $author === '' ||
    $genre === null || $genre === '' ||
    $isbn === null || $isbn === '' ||
    $published_date === null || $published_date === '' ||
    $format_id === null || $format_id === false) {

    $_SESSION['update_error'] = 'Invalid book data. Please fill in all fields and try again.';
    header('Location: update_error.php');
    die();
}

// Check for duplicate ISBN — EXCLUDING the current book
$queryCheck = 'SELECT bookID FROM books WHERE isbn = :isbn AND bookID != :bookID';
$statement = $db->prepare($queryCheck);
$statement->bindValue(':isbn', $isbn);
$statement->bindValue(':bookID', $book_id);
$statement->execute();
$existing = $statement->fetch();
$statement->closeCursor();

if ($existing) {
    $_SESSION['update_error'] = 'Another book already uses that ISBN. Please check the ISBN and try again.';
    header('Location: update_error.php');
    die();
}

// ----- Update the book -----

$query = 'UPDATE books
          SET title = :title,
              author = :author,
              genre = :genre,
              isbn = :isbn,
              publishedDate = :publishedDate,
              formatID = :formatID
          WHERE bookID = :bookID';

$statement = $db->prepare($query);
$statement->bindValue(':title', $title);
$statement->bindValue(':author', $author);
$statement->bindValue(':genre', $genre);
$statement->bindValue(':isbn', $isbn);
$statement->bindValue(':publishedDate', $published_date);
$statement->bindValue(':formatID', $format_id);
$statement->bindValue(':bookID', $book_id);
$statement->execute();
$statement->closeCursor();

// Store a message for the confirmation page
$_SESSION['updated_title'] = $title;

header('Location: update_book_confirmation.php');
die();