-- VKUShop — Buổi 04
-- Database mẫu cho Prepared Statement + CRUD bằng PDO.

CREATE DATABASE IF NOT EXISTS vkushop
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE vkushop;

DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;

CREATE TABLE categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(120) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id INT UNSIGNED NOT NULL,
    name VARCHAR(150) NOT NULL,
    price DECIMAL(12, 0) NOT NULL,
    stock INT UNSIGNED NOT NULL DEFAULT 0,
    description TEXT NULL,
    icon VARCHAR(20) NOT NULL DEFAULT '📦',
    CONSTRAINT fk_products_category
        FOREIGN KEY (category_id)
        REFERENCES categories(id)
) ENGINE=InnoDB;

INSERT INTO categories (name, slug)
VALUES
    ('Áo', 'shirt'),
    ('Phụ kiện', 'accessory'),
    ('Quà tặng', 'gift');

INSERT INTO products
    (category_id, name, price, stock, description, icon)
VALUES
    (1, 'Áo thun VKU', 150000, 20, 'Áo thun dành cho sinh viên VKU', '👕'),
    (2, 'Bình nước VKU', 120000, 0, 'Bình nước lưu niệm VKU', '🥤'),
    (2, 'Balo VKU', 350000, 8, 'Balo laptop VKU', '🎒'),
    (3, 'Sổ tay VKU', 50000, 35, 'Sổ tay nhỏ gọn', '📒'),
    (2, 'Mũ lưỡi trai VKU', 110000, 12, 'Mũ lưỡi trai VKU', '🧢'),
    (1, 'Áo khoác VKU', 420000, 5, 'Áo khoác VKU', '🧥'),
    (2, 'Túi tote VKU', 90000, 18, 'Túi tote sinh viên', '👜'),
    (3, 'Bộ quà tặng VKU', 300000, 6, 'Bộ quà tặng lưu niệm', '🎁');
