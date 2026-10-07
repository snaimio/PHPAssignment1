# PHPAssignment1 – Book Library with Image Upload & CRUD

A PHP + MySQL web application that manages a personal book library with full CRUD functionality, cover image uploads, automated thumbnail generation, and a dedicated book details view.

## Features

- **List Books:** View all books in a responsive catalog table with cover thumbnails, title, author, genre, ISBN, published date, and format.
- **Book Details:** Dedicated book details page (`book_details.php`) displaying the high-resolution cover image and complete metadata.
- **Add New Books:** Add books with real-time file upload, dynamic image preview, and server-side validation (empty fields, duplicate ISBN check).
- **Edit / Update Books:** Pre-filled edit form with current cover preview, live file replacement preview, and old file cleanup upon replacement.
- **Image Processing:** Automated thumbnail generation (`_100` for table/form previews and `_400` for details view) using PHP's GD library.
- **Delete Books:** Delete books along with a client-side confirmation check.
- **Format Categorization:** Relational database design linking books to format categories (Hardcover, Paperback, eBook, Audiobook, PDF) via foreign keys.
- **Security:** Fully secured with PDO prepared statements and output escaping against SQL injection and XSS.
- **Responsive Layout:** Clean warm palette styled with CSS Grid/Flexbox and media queries for desktop and mobile viewports.

## Technologies

- PHP 8 (PDO, GD library)
- MySQL / MariaDB
- HTML5 & CSS3
- JavaScript (Vanilla JS for live file preview)
- XAMPP (Apache + MySQL)

## Setup

**Prerequisite:** XAMPP installed and running.

### Step 1 — Place the project

Place this folder inside XAMPP's `htdocs` directory:

```
/Applications/XAMPP/xamppfiles/htdocs/PHPAssignment1/
```

### Step 2 — Start services

Open **XAMPP Control Panel** and start both:
- **Apache**
- **MySQL**

### Step 3 — Import the database

1. Open phpMyAdmin: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Click the **Import** tab at the top.
3. Click **Choose File** and select `database.sql` from this project directory.
4. Click **Go**.

The `database.sql` file will automatically:
- Create the `book_library` database
- Create the `books` and `formats` tables with relationships
- Insert sample book data with default image placeholders

### Step 4 — Run the app

Visit in your browser:

```
http://localhost/PHPAssignment1/index.php
```

## Default Database Configuration

The application connects using XAMPP default settings:
- **Host:** `localhost`
- **Database:** `book_library`
- **User:** `root`
- **Password:** *(empty)*

To change credentials, update `database.php`.

## Project Structure

```
PHPAssignment1/
├── css/
│   └── books2.css
├── images/
│   ├── placeholder.jpg
│   ├── placeholder_100.jpg
│   └── placeholder_400.jpg
├── add_book.php
├── add_book_confirmation.php
├── add_book_form.php
├── add_error.php
├── book_details.php
├── database.php
├── database.sql
├── database_error.php
├── delete_book.php
├── footer.php
├── functions.php
├── header.php
├── image_util.php
├── index.php
├── README.md
├── update_book.php
├── update_book_confirmation.php
├── update_book_form.php
└── update_error.php
```

## Author

Sheikh Naim
PHP Assignment — 2026