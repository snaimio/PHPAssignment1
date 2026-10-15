# PHP + MySQL Book Library

A full-featured PHP & MySQL web application developed iteratively across **Assignment 1**, **Assignment 2**, **Assignment 3**, and **Assignment 4**. It provides complete library management with relational database design, secure CRUD workflows, an automated GD image processing pipeline, and user authentication with brute-force lockout protection.

---

## Assignment Progression & Milestones

### Assignment 1: Database Design & Initial Setup
- **Relational Schema:** Designed `book_library` database with normalized `books` and `formats` tables connected via foreign key (`formatID`).
- **Database Connection:** Centralized PDO connection with robust error handling (`database.php` & `database_error.php`).
- **Catalog View:** Main catalog table displaying book records with format relationships.

### Assignment 2: Full CRUD & Security Hardening
- **Create (Add Book):** Form with server-side validation against empty fields and duplicate ISBN detection.
- **Read / List:** Styled catalog table with responsive adaptations.
- **Update (Edit Book):** Pre-populated edit form allowing book metadata modification.
- **Delete (Remove Book):** Safe book deletion with client-side confirmation.
- **Security:** Strict PDO prepared statements across all queries and `htmlspecialchars()` output escaping against XSS and SQL injection.

### Assignment 3: Image Upload, Processing & Details View
- **Multipart Form Uploads:** Added file upload support (`enctype="multipart/form-data"`) to Add and Update forms.
- **Automated GD Image Processing:** Custom `image_util.php` module using PHP's GD library to resize and generate:
  - `_100` thumbnails ($100\times100\text{px}$) for catalog and form previews.
  - `_400` medium images ($300\times300\text{px}$) for the details page.
- **Image Preview UI:** Dynamic JavaScript preview on file selection and a responsive `.form-image-box` preview container.
- **Storage Management:** Automatic removal of old image assets upon updating book covers (preserving default placeholders).
- **Book Details Page:** Dedicated view (`book_details.php`) showcasing the enlarged cover image and full book metadata.

### Assignment 4: User Authentication & Security (Registration, Login & Lockout)
- **User Registration (`register_user_form.php` & `register_user.php`):** User registration form with server-side validation for username, password, and email. Passwords are securely hashed using PHP's `password_hash()` (`PASSWORD_DEFAULT` / Bcrypt).
- **Duplicate Username Prevention:** Server-side duplicate checks query existing usernames and present friendly error messages (`user_error.php`).
- **Authentication & Sessions (`login_form.php` & `login.php`):** User login verifies credentials via `password_verify()` and initializes session state (`$_SESSION['isLoggedIn']`, `$_SESSION['userName']`, and `$_SESSION['userID']`).
- **Brute-Force Protection & Account Lockout:** Tracks failed attempts in the database. Locks accounts for 5 minutes (300 seconds) after 3 consecutive failed login attempts.
- **Dynamic Lockout Countdown:** Real-time JavaScript timer (`js/login_countdown.js`) that displays remaining lockout seconds on `login_form.php` and auto-reloads the page when the lockout expires.
- **Protected Access Control / Auth Gates:** Auth check ensures only authenticated users can access the catalog (`index.php`), add books (`add_book_form.php`, `add_book.php`), edit books (`update_book_form.php`, `update_book.php`), delete books (`delete_book.php`), or view details (`book_details.php`). Unauthenticated requests redirect to `login_form.php`.
- **Logout Flow (`logout.php`):** Secure session termination and redirection back to login.

---

## Technologies Used

- **Backend:** PHP 8 (PDO, GD Library, Password Hashing API, PHP Sessions)
- **Database:** MySQL / MariaDB
- **Frontend:** HTML5, CSS3, JavaScript (DOM, File API, Countdown Timers)
- **Environment:** XAMPP (Apache + MySQL)

---

## Screenshots

### 1. Catalog View (All Books)
![All Books Catalog](screenshots/all_books_catalog.png)

### 2. Update Book & Live Image Preview
![Update Book Form](screenshots/update_book_form.png)

### 3. Book Details Views
| Atomic Habits | The Psychology of Money |
| :---: | :---: |
| ![Book Details - Atomic Habits](screenshots/book_details_1.png) | ![Book Details - The Psychology of Money](screenshots/book_details_2.png) |

---

## Setup & Installation

**Prerequisite:** XAMPP installed and running.

### 1. Project Location
Clone or place this repository inside your XAMPP `htdocs` directory:
```
/Applications/XAMPP/xamppfiles/htdocs/PHPAssignment1/
```

### 2. Start Services
Launch **XAMPP Control Panel** and start **Apache** and **MySQL**.

### 3. Database Setup (Single-Step Import)
1. Open phpMyAdmin at [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
2. Go to the **Import** tab.
3. Choose `database.sql` from the root of this project and click **Go**.

The script will automatically create the database, tables (`books`, `formats`, `registrations`), relationships, and populate seed book records and image references.

### 4. Run the Application
Open your browser and navigate to:
```
http://localhost/PHPAssignment1/login_form.php
```
*(Or navigate to `index.php`, which will automatically direct you to `login_form.php` if not logged in).*

---

## Database Configuration

Default settings in `database.php`:
- **Host:** `localhost`
- **Database:** `book_library`
- **User:** `root`
- **Password:** *(blank / empty by default in XAMPP)*

---

## Project Structure

```
PHPAssignment1/
├── css/
│   └── books2.css                # Application stylesheet with responsive media queries
├── images/
│   ├── placeholder.jpg           # Default fallback image
│   ├── placeholder_100.jpg       # Default 100px thumbnail
│   └── placeholder_400.jpg       # Default 400px details image
├── js/
│   └── login_countdown.js        # Dynamic countdown timer for account lockout
├── screenshots/
│   ├── all_books_catalog.png     # Screenshot of catalog table
│   ├── book_details_1.png        # Screenshot of book details view (1)
│   ├── book_details_2.png        # Screenshot of book details view (2)
│   └── update_book_form.png      # Screenshot of update form with image preview
├── add_book.php                  # Add book backend handler & image processor
├── add_book_confirmation.php     # Confirmation screen after adding a book
├── add_book_form.php             # Form to add a new book (auth protected)
├── add_error.php                 # Add book error view
├── book_details.php              # Full book details view with large cover (auth protected)
├── database.php                  # PDO database connection configuration
├── database.sql                  # Complete SQL schema, constraints & seed data
├── database_error.php            # Database connection failure screen
├── database_infinityfree.sql     # InfinityFree hosting SQL configuration
├── delete_book.php               # Book deletion backend handler & image cleanup (auth protected)
├── footer.php                    # Shared page footer
├── functions.php                 # Helper functions (e.g., e() for htmlspecialchars)
├── header.php                    # Shared page header and CSS link
├── image_util.php                # GD image resizing & thumbnail generation utility
├── index.php                     # Main catalog table listing all books (auth protected)
├── LICENSE                       # MIT License
├── login.php                     # Login backend handler with lockout logic
├── login_confirmation.php        # Welcome confirmation screen upon login
├── login_form.php                # User login form with lockout countdown
├── logout.php                    # User logout handler & session destruction
├── README.md                     # Project documentation & assignment milestones
├── register_user.php             # User registration handler & password hashing
├── register_user_confirmation.php# Confirmation screen upon user registration
├── register_user_form.php        # User registration form
├── update_book.php               # Update book backend handler & image updater (auth protected)
├── update_book_confirmation.php  # Confirmation screen after updating a book
├── update_book_form.php          # Pre-filled edit form with live preview (auth protected)
├── update_error.php              # Update book error view
└── user_error.php                # User registration & authentication error view
```

---

## License

This project is licensed under the MIT License — see the [LICENSE](LICENSE) file for details.

---

## Author

**Sheikh Naim**  
PHP Assignments (1, 2, 3, and 4) — 2026