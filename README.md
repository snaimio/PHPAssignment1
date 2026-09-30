# PHPAssignment2 – Book Library with CRUD

A PHP + MySQL app that manages a personal book library with full CRUD functionality.

## Features

- **List books** with title, author, genre, ISBN, publish date, and format
- **Add new books** with server-side validation (empty fields, duplicate ISBN)
- **Edit existing books** with pre-filled forms
- **Delete books** with a confirmation dialog
- **Format categorization** (Hardcover, Paperback, eBook, Audiobook, PDF) using a foreign key relationship
- **Responsive layout** — table adapts to screen size
- **PDO prepared statements** throughout for security
- **Output escaping** to prevent XSS

## Technologies

- PHP 8
- MySQL
- HTML5 + CSS3
- XAMPP (Apache + MySQL)

## Setup

**Prerequisite:** XAMPP installed and running.

### Step 1 — Place the project

Put this folder inside XAMPP's `htdocs` directory:

```
/Applications/XAMPP/xamppfiles/htdocs/PHPAssignment1/
```

### Step 2 — Start services

Open **XAMPP Control Panel** and start both:

- Apache
- MySQL

### Step 3 — Import the database (one step)

1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Click the **Import** tab at the top
3. Click **Choose File** and select `database.sql`
4. Click **Go**

**That's it.** The `database.sql` file:

- Creates the `book_library` database
- Creates the `books` and `formats` tables
- Sets up the foreign key
- Inserts all sample book data

No manual database creation needed — the SQL file handles everything.

### Step 4 — Run the app

Visit:

```
http://localhost/PHPAssignment1/index.php
```

## Default Credentials

The app assumes MySQL with:

- **User:** `root`
- **Password:** (empty — XAMPP default)

If your MySQL uses different credentials, update them in `database.php`.

## Project Structure

```
PHPAssignment1/
├── css/
│   └── books2.css
├── add_book.php
├── add_book_confirmation.php
├── add_book_form.php
├── add_error.php
├── database.php
├── database.sql
├── database_error.php
├── delete_book.php
├── footer.php
├── functions.php
├── header.php
├── index.php
├── README.md
├── update_book.php
├── update_book_confirmation.php
├── update_book_form.php
└── update_error.php
```

## Author

Sheikh Naim
PHP Assignment 2 — 2026