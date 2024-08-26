DROP DATABASE IF EXISTS tienda;
CREATE DATABASE tienda;
USE tienda;
-- En un futuro: para tablas con informacion critica debemos tener en cuenta el usar UUID
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role ENUM('buyer', 'seller', 'admin') DEFAULT "buyer",
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE buyers (
    id INT PRIMARY KEY,
    fullname VARCHAR(255) NULL,
    address VARCHAR(255) NULL,
    phone VARCHAR(255) NULL,
    birthdate DATE  NULL,
    FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE sellers (
    id INT PRIMARY KEY,
    rut VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    address VARCHAR(255) NULL,
    phone VARCHAR(255) NULL,
    website VARCHAR(255) NULL,
    logo_url VARCHAR(255) NULL,
    FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category VARCHAR(100),
    stock INT DEFAULT 0,
    state ENUM('disponible', 'agotado', 'próximamente') DEFAULT 'disponible'
);

CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    image_url VARCHAR(255) NOT NULL,
    alt_text VARCHAR(255),
    width INT NOT NULL,
    height INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE carts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    status ENUM('active', 'completed', 'abandoned') DEFAULT 'active',
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE cart_lines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (cart_id) REFERENCES carts(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
/* Para ejecutar via terminal
SOURCE ./triggers.sql;
SOURCE ./default_data.sql;
*/