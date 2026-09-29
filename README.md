# PHPAssignment1 – Book Library

A small PHP + MySQL app that displays a personal library of books
focused on psychology, parenting, and personal development.

## Features

- Lists every book with title, author, genre, ISBN, and publication date
- Uses PDO prepared statements for the SELECT query
- Escapes all output to prevent XSS
- Separate `header.php` and `footer.php` for a reusable layout
- Friendly `database_error.php` page with a session-passed message
- Responsive CSS layout

## Technologies

- PHP 8
- MySQL (via PDO)
- HTML5
- CSS3
- XAMPP (Apache + MySQL)

## Project Structure

```
PHPAssignment1/
├── css/
│   └── books.css
├── database.php
├── database.sql
├── database_error.php
├── footer.php
├── header.php
├── index.php
├── README.md
└── .gitignore
```

## Setup

1. Place this folder inside XAMPP's `htdocs` directory.
2. Start Apache and MySQL from the XAMPP control panel.
3. In phpMyAdmin, import `database.sql`:
   - Click the **Import** tab at the top
   - Choose `database.sql`
   - Click **Go**

   The file creates the `book_library` database, the `books` table,
   and inserts 10 sample books — all in one step.
4. Update credentials in `database.php` if your MySQL user differs.
   The defaults are `root` with an empty password, which is standard for XAMPP.
5. Visit `http://localhost/PHPAssignment1/index.php`.

## Author

Sheikh Naim
PHP Assignment 1 — 2026