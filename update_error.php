<?php
/**
 * update_error.php
 * Friendly error page shown when an Update Book submission fails validation.
 */

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require('functions.php');

$errorMessage = $_SESSION['update_error'] ?? 'Unknown error.';
unset($_SESSION['update_error']);

$pageTitle = 'Update Error';

require('header.php');
?>

<main>
    <h2>Update Book Error</h2>

    <p><strong>Message:</strong> <?= e($errorMessage) ?></p>

    <p><a href="index.php">View Book List</a></p>
</main>

<?php require('footer.php'); ?>