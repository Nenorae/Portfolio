-- ERD Representasi dari Skema Database Aplikasi Portfolio
-- Dibuat berdasarkan file migrasi Laravel

-- =============================================
-- Tabel: users
-- Deskripsi: Menyimpan data pengguna utama aplikasi.
-- =============================================
CREATE TABLE users (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL COMMENT 'Nama Lengkap',
    username VARCHAR(255) NULL UNIQUE,
    nim VARCHAR(255) NULL UNIQUE COMMENT 'Wajib ada untuk beberapa fitur',
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    profile_photo VARCHAR(255) NULL,
    bio TEXT NULL,
    website VARCHAR(255) NULL,
    followers_count INT NOT NULL DEFAULT 0,
    following_count INT NOT NULL DEFAULT 0,
    posts_count INT NOT NULL DEFAULT 0,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- =============================================
-- Tabel: posts
-- Deskripsi: Menyimpan data postingan/proyek yang dibuat oleh pengguna.
-- Relasi:
--   - `user_id` terhubung ke `users(id)` (Satu user bisa punya banyak post).
-- =============================================
CREATE TABLE posts (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    caption TEXT NULL,
    image VARCHAR(255) NULL COMMENT 'Path ke file gambar',
    github_link VARCHAR(255) NULL,
    demo_link VARCHAR(255) NULL,
    category VARCHAR(255) NULL COMMENT 'Contoh: IoT, Web App',
    likes_count INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX posts_user_id_index (user_id),
    INDEX posts_created_at_index (created_at),
    INDEX posts_category_index (category),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =============================================
-- Tabel: likes
-- Deskripsi: Tabel pivot untuk relasi Many-to-Many antara `users` dan `posts`.
-- Relasi:
--   - `user_id` terhubung ke `users(id)`.
--   - `post_id` terhubung ke `posts(id)`.
-- =============================================
CREATE TABLE likes (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    post_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    UNIQUE KEY likes_user_id_post_id_unique (user_id, post_id),
    INDEX likes_user_id_index (user_id),
    INDEX likes_post_id_index (post_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

-- =============================================
-- Tabel: follows
-- Deskripsi: Tabel pivot untuk relasi follow antar pengguna (self-referencing Many-to-Many).
-- Relasi:
--   - `follower_id` terhubung ke `users(id)` (Pengguna yang melakukan follow).
--   - `following_id` terhubung ke `users(id)` (Pengguna yang di-follow).
-- =============================================
CREATE TABLE follows (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    follower_id BIGINT UNSIGNED NOT NULL COMMENT 'Yang follow',
    following_id BIGINT UNSIGNED NOT NULL COMMENT 'Yang di-follow',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    UNIQUE KEY follows_follower_id_following_id_unique (follower_id, following_id),
    INDEX follows_follower_id_index (follower_id),
    INDEX follows_following_id_index (following_id),
    FOREIGN KEY (follower_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (following_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =============================================
-- Tabel: skills
-- Deskripsi: Menyimpan daftar keahlian yang dimiliki oleh pengguna.
-- Relasi:
--   - `user_id` terhubung ke `users(id)` (Satu user bisa punya banyak skill).
-- =============================================
CREATE TABLE skills (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =============================================
-- Tabel: notifications
-- Deskripsi: Menyimpan notifikasi untuk pengguna (misal: like baru, follower baru).
-- Relasi: Polymorphic. Kolom `notifiable_id` dan `notifiable_type` akan merujuk
--         ke model lain, umumnya ke tabel `users`. Contoh:
--         - notifiable_id: 1
--         - notifiable_type: 'App\Models\User'
--         Ini tidak bisa direpresentasikan dengan FOREIGN KEY standar di SQL.
-- =============================================
CREATE TABLE notifications (
    id CHAR(36) NOT NULL PRIMARY KEY,
    type VARCHAR(255) NOT NULL,
    notifiable_type VARCHAR(255) NOT NULL,
    notifiable_id BIGINT UNSIGNED NOT NULL,
    data TEXT NOT NULL COMMENT 'Menyimpan data notifikasi dalam format JSON',
    read_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX notifications_notifiable_type_notifiable_id_index (notifiable_type, notifiable_id)
);


-- Catatan Tambahan:
-- Tabel-tabel bawaan Laravel seperti `password_reset_tokens`, `sessions`, `cache`, `jobs`,
-- `job_batches`, dan `failed_jobs` tidak disertakan dalam ERD ini karena lebih bersifat
-- fungsionalitas framework dan bukan bagian dari model domain inti aplikasi.
