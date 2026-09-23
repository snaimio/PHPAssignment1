# PHPAssignment1 – Book Library

A small PHP + MySQL app that displays a personal library of books
focused on psychology, parenting, and personal development.

## Features
- Lists every book with title, author, genre, ISBN, and publication date
- Uses PDO prepared statements for the SELECT query
- Escapes all output to prevent XSS
- Separate `header.php` and `footer.php` for a reusable layout
- Friendly database error page with a session-passed message

## Setup
1. Place this folder inside XAMPP's `htdocs` directory.
2. Start Apache and MySQL from the XAMPP control panel.
3. In phpMyAdmin, create a database called `book_library`.
4. Import `database.sql` (SQL tab → paste → Go).
5. Update credentials in `database.php` if your MySQL user differs.
6. Visit `http://localhost/PHPAssignment1/index.php`.