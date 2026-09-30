# PHPAssignment2 – Book Library with CRUD

A PHP + MySQL app that manages a personal book library with full CRUD functionality.

## Features

- List books with title, author, genre, ISBN, publish date, and format
- Add new books with server-side validation (empty fields, duplicate ISBN)
- Edit existing books with pre-filled forms
- Delete books with a confirmation dialog
- Format categorization (Hardcover, Paperback, eBook, Audiobook, PDF)
- Responsive layout
- PDO prepared statements throughout
- Output escaping to prevent XSS

## Setup

1. Place this folder inside XAMPP's `htdocs` directory.
2. Start Apache and MySQL.
3. Import `database.sql` via phpMyAdmin.
4. Update credentials in `database.php` if your MySQL user differs.
5. Visit `http://localhost/PHPAssignment1/index.php`.

## Author

Sheikh Naim
PHP Assignment 2 — 2026