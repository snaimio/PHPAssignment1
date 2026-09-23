<?php
/**
 * database_error.php
 * Friendly page shown when the DB connection fails.
 * Reads the message database.php saved in the session.
 */

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Read once, then clear — a refresh shouldn't show a stale message
$errorMessage = $_SESSION['database_error'] ?? 'Unknown database error.';
unset($_SESSION['database_error']);

$pageTitle = 'Database Error';

require('header.php');
?>

<main>
    <h2>Database Error</h2>
    <p>There was an error connecting to the database.</p>
    <p>The database must be installed.</p>
    <p>MySQL must be running.</p>
    <p><strong>Message:</strong> <?= htmlspecialchars($errorMessage) ?></p>
    <p><a href="index.php">Back to Book List</a></p>
</main>

<?php require('footer.php'); ?>