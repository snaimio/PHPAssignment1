<?php
/**
 * login_confirmation.php
 * Success page shown right after a user logs in.
 */

declare(strict_types=1);

require('functions.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userName = $_SESSION['userName'] ?? 'User';
$pageTitle = 'Login Successful';

require('header.php');
?>

<main>
    <h2>Login Successful</h2>

    <p>
        Welcome back, <strong><?= e($userName) ?></strong>.
        You are logged in and ready to use the Book Library.
    </p>

    <p><a href="index.php">Go to Book List</a></p>
    <p><a href="logout.php">Log Out</a></p>
</main>

<?php require('footer.php'); ?>