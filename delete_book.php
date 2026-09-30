<?php
/**
 * delete_book.php
 * Handles the Delete Book button from index.php.
 * Receives book_id via POST, deletes the book, redirects to the list.
 */

declare(strict_types=1);

session_start();

// Get the book_id from the POST
$book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

// If no valid ID was sent, go back to the list
if ($book_id === null || $book_id === false) {
    header('Location: index.php');
    die();
}

require_once('database.php');

// Delete the book
$query = 'DELETE FROM books WHERE bookID = :bookID';
$statement = $db->prepare($query);
$statement->bindValue(':bookID', $book_id);
$statement->execute();
$statement->closeCursor();

// Go back to the list
header('Location: index.php');
die();