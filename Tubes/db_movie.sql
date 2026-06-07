-- ====================================================================
-- 1. PEMBUATAN DATABASE
-- ====================================================================
CREATE DATABASE IF NOT EXISTS db_movie;
USE db_movie;

-- ====================================================================
-- 2. TABEL INDEPENDEN (Tidak bergantung pada tabel lain)
-- ====================================================================

-- Tabel User
CREATE TABLE IF NOT EXISTS users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Diisi hash password untuk keamanan
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabel Movie / Film
CREATE TABLE IF NOT EXISTS movies (
    id_movie INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    release_date DATE,
    duration INT, -- Durasi dalam hitungan menit
    poster_url VARCHAR(255) DEFAULT 'poster-placeholder.jpg',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabel Master Genre
CREATE TABLE IF NOT EXISTS genres (
    id_genre INT AUTO_INCREMENT PRIMARY KEY,
    genre_name VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Tabel Master Merchandise (Untuk fitur monetisasi)
CREATE TABLE IF NOT EXISTS merchandise (
    id_merch INT AUTO_INCREMENT PRIMARY KEY,
    merch_name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0
) ENGINE=InnoDB;


-- ====================================================================
-- 3. TABEL DEPENDEN (Memiliki relasi / Foreign Key)
-- ====================================================================

-- Tabel Asosiatif Movie <-> Genre (Many-to-Many)
CREATE TABLE IF NOT EXISTS movie_genres (
    id_movie INT,
    id_genre INT,
    PRIMARY KEY (id_movie, id_genre), -- Composite Primary Key
    FOREIGN KEY (id_movie) REFERENCES movies(id_movie) ON DELETE CASCADE,
    FOREIGN KEY (id_genre) REFERENCES genres(id_genre) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabel Galeri Foto Film (One-to-Many dari Movie)
CREATE TABLE IF NOT EXISTS movie_images (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_movie INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_movie) REFERENCES movies(id_movie) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabel Reviews (Gabungan Comments & Ratings hasil optimasi)
CREATE TABLE IF NOT EXISTS reviews (
    id_review INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_movie INT NOT NULL,
    rating TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5), -- Batasan rating 1-5 bintang
    review_text TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_movie) REFERENCES movies(id_movie) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabel Reaksi Komentar / Ulasan
CREATE TABLE IF NOT EXISTS review_reactions (
    id_reaction INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_review INT NOT NULL,
    reaction_type ENUM('like', 'dislike') NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_review) REFERENCES reviews(id_review) ON DELETE CASCADE,
    UNIQUE KEY unique_user_reaction (id_user, id_review) -- User hanya boleh react 1 kali per review
) ENGINE=InnoDB;

-- Tabel User Watchlists (Gabungan Favorite & Watchlist hasil optimasi)
CREATE TABLE IF NOT EXISTS user_watchlists (
    id_watchlist INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_movie INT NOT NULL,
    status ENUM('Plan to Watch', 'Watching', 'Completed', 'Dropped') DEFAULT 'Plan to Watch',
    is_favorite TINYINT(1) DEFAULT 0, -- 0 = Biasa, 1 = Favorit (Menggantikan fungsi tabel lama)
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_movie) REFERENCES movies(id_movie) ON DELETE CASCADE,
    UNIQUE KEY unique_user_movie_watchlist (id_user, id_movie) -- 1 user hanya punya 1 record per film
) ENGINE=InnoDB;

-- Tabel Nota Pembelian (Invoices)
CREATE TABLE IF NOT EXISTS invoices (
    id_invoice INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    payment_status ENUM('Pending', 'Paid', 'Cancelled') DEFAULT 'Pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE RESTRICT -- Invoice tidak boleh hilang jika user dihapus (arsip keuangan)
) ENGINE=InnoDB;

-- Tabel Detail Item Pembelian Merchandise (Invoice Details)
CREATE TABLE IF NOT EXISTS invoice_details (
    id_invoice_detail INT AUTO_INCREMENT PRIMARY KEY,
    id_invoice INT NOT NULL,
    id_merch INT NOT NULL,
    quantity INT NOT NULL CHECK (quantity > 0),
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_invoice) REFERENCES invoices(id_invoice) ON DELETE CASCADE,
    FOREIGN KEY (id_merch) REFERENCES merchandise(id_merch) ON DELETE RESTRICT
) ENGINE=InnoDB;