-- CREATE DATABASE
CREATE DATABASE IF NOT EXISTS nomuk_library;
USE nomuk_library;

-- =========================
-- USERS TABLE (AUTH SYSTEM)
-- =========================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- AISLES
-- =========================
CREATE TABLE aisles (
    aisle_id INT AUTO_INCREMENT PRIMARY KEY,
    aisle_number INT NOT NULL,
    category VARCHAR(50)
);

-- =========================
-- BOOKS
-- =========================
CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    author VARCHAR(100),
    category VARCHAR(50),
    aisle_id INT,
    FOREIGN KEY (aisle_id) REFERENCES aisles(aisle_id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- =========================
-- BOOK COPIES (IMPORTANT)
-- =========================
CREATE TABLE book_copies (
    copy_id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT NOT NULL,
    status ENUM('AVAILABLE', 'BORROWED', 'MAINTENANCE') DEFAULT 'AVAILABLE',

    FOREIGN KEY (book_id) REFERENCES books(book_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- =========================
-- TRANSACTIONS (CORE SYSTEM)
-- =========================
CREATE TABLE transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    copy_id INT NOT NULL,

    borrow_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    due_date DATETIME NOT NULL,
    return_date DATETIME,

    status ENUM('BORROWED', 'RETURNED', 'OVERDUE') DEFAULT 'BORROWED',

    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (copy_id) REFERENCES book_copies(copy_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- =========================
-- OPTIONAL: ANNOUNCEMENTS
-- =========================
CREATE TABLE announcements (
    announcement_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- OPTIONAL: INDEXES (PERFORMANCE)
-- =========================
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_books_title ON books(title);
CREATE INDEX idx_transactions_user ON transactions(user_id);
CREATE INDEX idx_transactions_status ON transactions(status);