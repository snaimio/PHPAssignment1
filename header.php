<?php
/**
 * header.php
 * Top half of every page.
 */

declare(strict_types=1);

$pageTitle = $pageTitle ?? 'Book Library';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> - Book Library</title>
    <link rel="stylesheet" href="css/books2.css?v=5">
</head>
<body>

<h1>📚 Book Library</h1>