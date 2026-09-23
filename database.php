<?php
/**
 * database.php
 * Sets up the PDO connection to the book_library database.
 * If the connection fails, stashes a friendly message in the session
 * and redirects the user to the error page.
 */

declare(strict_types=1);

// Which driver, host, database, and charset to use
$dsn = 'mysql:host=localhost;dbname=book_library;charset=utf8mb4';

// Options that keep PDO predictable and safe
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $db = new PDO($dsn, 'root', '', $options);
} catch (PDOException $e) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['database_error'] = 'A database error has occurred.';
    error_log('[Book Library] DB error: ' . $e->getMessage());

    header('Location: database_error.php');
    exit();
}