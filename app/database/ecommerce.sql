DROP DATABASE IF EXISTS ecommerce;
CREATE DATABASE ecommerce;
USE ecommerce;
-- En un futuro: para tablas con informacion critica debemos tener en cuenta el usar UUID
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role ENUM('buyer', 'seller', 'admin') NOT NULL DEFAULT "buyer",
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    document_number VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    active TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE buyers (
    id INT PRIMARY KEY,
    birthdate DATE  NULL,
    FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE sellers (
    id INT PRIMARY KEY,
    description TEXT NULL,
    website VARCHAR(255) NULL,
    logo_url VARCHAR(255) NULL,
    mercadopago_account VARCHAR(255) NULL,
    paypal_account VARCHAR(255) NULL,
    FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE phones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    number VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE addresses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    street VARCHAR(255),
    city VARCHAR(255),
    state VARCHAR(255),
    postal_code VARCHAR(255),
    country VARCHAR(255),
    type ENUM('home', 'work', 'other') DEFAULT 'home',
    description VARCHAR(255) NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE discounts (
	id INT AUTO_INCREMENT PRIMARY KEY,
    seller_id INT,
    name VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    active TINYINT DEFAULT 1,
    type TINYINT DEFAULT 0, -- 0: porcentaje, 1: fijo
    value INT NOT NULL,
    max INT,
    FOREIGN KEY (seller_id) REFERENCES sellers(id)
);

CREATE TABLE categories (
	id INT AUTO_INCREMENT PRIMARY KEY,
    discount_id INT,
    name VARCHAR(255),
    FOREIGN KEY (discount_id) REFERENCES discounts(id)
);

CREATE TABLE category_keywords (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    keyword VARCHAR(255) NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    UNIQUE(category_id, keyword)
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT DEFAULT 1,
    seller_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (seller_id) REFERENCES sellers(id)
);

CREATE TABLE product_variants(
	id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    discount_id INT,
    stock INT DEFAULT 1,
    current_price DECIMAL(10, 2),
    last_price DECIMAL(10, 2),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (discount_id) REFERENCES discounts(id)
);

CREATE TABLE variant_attributes(
	id INT AUTO_INCREMENT PRIMARY KEY,
    variant_id INT NOT NULL,
    name VARCHAR(255),
    value VARCHAR(255),
    FOREIGN KEY (variant_id) REFERENCES product_variants(id),
    UNIQUE(variant_id, name)
);

CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    variant_id INT,
    src VARCHAR(255) NOT NULL,
    alt VARCHAR(255),
    FOREIGN KEY (variant_id) REFERENCES product_variants(id)
);

CREATE TABLE carts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_price DECIMAL(10, 2) DEFAULT 0,
    status TINYINT DEFAULT 0, -- 0: active, 1: completed
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
-- !Crear trigger para actualizar carts al actualizar una de sus lineas

CREATE TABLE cart_lines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT NOT NULL,
    variant_id INT NOT NULL,
    quantity INT DEFAULT 1,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (cart_id) REFERENCES carts(id),
    FOREIGN KEY (variant_id) REFERENCES product_variants(id)
);