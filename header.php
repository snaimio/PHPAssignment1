<?php
/**
 * header.php
 * Top half of every page: doctype, <head>, and the site heading.
 * Pages can set $pageTitle before including this file to
 * customise the browser tab text.
 */

declare(strict_types=1);

$pageTitle = $pageTitle ?? 'Book Library';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle) ?> - Book Library</title>
    <link rel="stylesheet" href="css/books.css">
</head>
<body>

<h1>📚 Book Library</h1>