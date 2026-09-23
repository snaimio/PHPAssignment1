<?php
/**
 * index.php
 * Home page. Fetches all books and shows them in a table.
 * Uses header.php and footer.php for the surrounding layout.
 */

declare(strict_types=1);

require('database.php');

/**
 * Escape a value for safe HTML output.
 * Small helper so the template markup stays readable.
 */
function e(?string $value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

// Shows up in the browser tab
$pageTitle = 'Home';

// Only grab the columns we actually display, sorted by title
$query = 'SELECT title, author, genre, isbn, publishedDate
          FROM books
          ORDER BY title';

$statement = $db->prepare($query);
$statement->execute();
$rows = $statement->fetchAll();
$statement->closeCursor();

// Data is ready — now bring in the top of the page
require('header.php');
?>

<main>
    <h2>All Books</h2>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>ISBN</th>
                <th>Published</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($rows)): ?>
                <tr><td colspan="5">No books found.</td></tr>
            <?php else: ?>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= e($row['title']) ?></td>
                        <td><?= e($row['author']) ?></td>
                        <td><?= e($row['genre']) ?></td>
                        <td><?= e($row['isbn']) ?></td>
                        <td><?= e($row['publishedDate']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php require('footer.php'); ?>