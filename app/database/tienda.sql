DROP DATABASE IF EXISTS tienda;
CREATE DATABASE tienda;
USE tienda

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_type VARCHAR(255) NOT NULL,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255),
    category VARCHAR(100),
    stock INT DEFAULT 0,
    state ENUM('disponible', 'agotado', 'próximamente') DEFAULT 'disponible'
);


INSERT INTO users VALUES
(1, "admin", "Anibal Boggio", "anibalboggio12.6.2006@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-06-12"),
(2, "admin", "Facundo Canclini", "facundocanclini27@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-07-28"),
(3, "admin", "Lautaro da Rosa", "laudarosa12@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-07-19"),
(4, "admin", "Luca Gómez", "lucaestudio14@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-08-16"),
(5, "admin", "Marcos Muñoz", "marcosestudio13@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-09-23");

INSERT INTO products 
(id, name, description, price, image_url, category, stock, state) VALUES
(1, "Camisa", "Camisa de algodón lorem ipsum dolor sit amer conseqctur", 19.99, "https://www.oggo.com.uy/web/image/product.template/962/image_256/%5B50HDA2250X50%5D%20Ceramica%2050HDA22%2050x50?unique=66f580d", "Ropa", 10, "disponible"),
(2, "Pantalón", "Pantalón de mezclilla lorem ipsum dolor sit amer conseqctur", 29.99, "https://www.oggo.com.uy/web/image/product.template/962/image_256/%5B50HDA2250X50%5D%20Ceramica%2050HDA22%2050x50?unique=66f580d", "Ropa", 5, "agotado"),
(3, "Zapatos", "Zapatos de cuero lorem ipsum dolor sit amer conseqctur", 39.99, "https://www.oggo.com.uy/web/image/product.template/962/image_256/%5B50HDA2250X50%5D%20Ceramica%2050HDA22%2050x50?unique=66f580d", "Calzado", 20, "próximamente"),
(4, "Bolso", "Bolso de cuero lorem ipsum dolor sit amer conseqctur", 24.99, "https://www.oggo.com.uy/web/image/product.template/962/image_256/%5B50HDA2250X50%5D%20Ceramica%2050HDA22%2050x50?unique=66f580d", "Accesorios", 15, "disponible"),
(5, "Gafas de sol", "Gafas de sol polarizada lorem ipsum dolor sit amer conseqctur", 14.99, "https://www.oggo.com.uy/web/image/product.template/962/image_256/%5B50HDA2250X50%5D%20Ceramica%2050HDA22%2050x50?unique=66f580d", "Accesorios", 20, "disponible"),
(6, "Reloj", "Reloj de pulsera lorem ipsum dolor sit amer conseqctur", 49.99, "https://www.oggo.com.uy/web/image/product.template/962/image_256/%5B50HDA2250X50%5D%20Ceramica%2050HDA22%2050x50?unique=66f580d", "Accesorios", 0, "agotado"),
(7, "Chaqueta", "Chaqueta de cuero lorem ipsum dolor sit amer conseqctur", 34.99, "https://www.oggo.com.uy/web/image/product.template/962/image_256/%5B50HDA2250X50%5D%20Ceramica%2050HDA22%2050x50?unique=66f580d", "Ropa", 12, "disponible"),
(8, "Bufanda", "Bufanda de lana lorem ipsum dolor sit amer conseqctur", 9.99, "https://www.oggo.com.uy/web/image/product.template/962/image_256/%5B50HDA2250X50%5D%20Ceramica%2050HDA22%2050x50?unique=66f580d", "Ropa", 18, "disponible"),
(9, "Vestido", "Vestido de fiesta lorem ipsum dolor sit amer conseqctur", 29.99, "https://www.oggo.com.uy/web/image/product.template/962/image_256/%5B50HDA2250X50%5D%20Ceramica%2050HDA22%2050x50?unique=66f580d", "Ropa", 0, "agotado"),
(10, "Zapatillas", "Zapatillas de running lorem ipsum dolor sit amer conseqctur", 44.99, "https://www.oggo.com.uy/web/image/product.template/962/image_256/%5B50HDA2250X50%5D%20Ceramica%2050HDA22%2050x50?unique=66f580d", "Calzado", 10, "disponible");