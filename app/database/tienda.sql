DROP DATABASE IF EXISTS tienda;
CREATE DATABASE tienda;
USE tienda
-- En un futuro: para tablas con informacion critica debemos tener en cuenta el usar UUID
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_type VARCHAR(255)  NULL,
    fullname VARCHAR(255)  NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    birthdate DATE  NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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

-- CREATE TABLE cart (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     user_id INT NOT NULL,
--     product_id INT NOT NULL,
--     quantity INT DEFAULT 1,
--     FOREIGN KEY (user_id) REFERENCES users(id),
--     FOREIGN KEY (product_id) REFERENCES products(id)
-- );

INSERT INTO users 
(user_type, fullname, email, password_hash, birthdate)VALUES
("admin", "Anibal Boggio", "anibalboggio12.6.2006@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-06-12"),
("admin", "Facundo Canclini", "facundocanclini27@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-07-28"),
("admin", "Lautaro da Rosa", "laudarosa12@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-07-19"),
("admin", "Luca Gómez", "lucaestudio14@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-08-16"),
("admin", "Marcos Muñoz", "marcosestudio13@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-09-23");

INSERT INTO products 
(name, description, price, category, stock, state) VALUES
("Camisa", "Camisa de algodón 100% de alta calidad, diseñada para ofrecer un ajuste cómodo y transpirable. Disponible en una amplia gama de colores, incluyendo blanco, azul, y negro. Cuenta con un corte clásico que se adapta a cualquier estilo. Disponible en talles S, M, L y XL. Ideal para usar tanto en el trabajo como en eventos casuales.", 19.99, "Ropa", 10, "disponible"),
("Pantalón", "Pantalón de mezclilla premium, confeccionado con una mezcla de algodón y elastano que proporciona flexibilidad y durabilidad. Disponible en colores clásicos como azul oscuro, negro y gris. Corte regular fit, con bolsillos delanteros y traseros funcionales. Ideal para combinar con camisas o camisetas para un look casual o semi-formal. Talles disponibles desde 28 hasta 38.", 29.99, "Ropa", 5, "agotado"),
("Zapatos", "Zapatos de cuero genuino, diseñados para brindar elegancia y confort. Disponen de una suela de goma antideslizante y un forro interno de piel suave para mayor comodidad durante todo el día. Disponibles en colores negro y marrón, perfectos para combinar con atuendos formales o casuales. Talles disponibles del 38 al 45.", 39.99, "Calzado", 20, "próximamente"),
("Bolso", "Bolso de cuero auténtico con acabados artesanales, ideal para el uso diario. Cuenta con varios compartimentos internos y externos con cierre, perfectos para organizar tus pertenencias. Disponible en colores negro y marrón. Asa ajustable y desmontable para mayor versatilidad. Dimensiones: 30 cm x 25 cm x 10 cm.", 24.99, "Accesorios", 15, "disponible"),
("Gafas de sol", "Gafas de sol polarizadas con protección UV400, ideales para proteger tus ojos de los rayos solares mientras mantienes un estilo moderno. Montura resistente de policarbonato, disponible en colores negro, azul y edición especial. Lentes polarizados que reducen el deslumbramiento. Incluye estuche protector y paño de limpieza.", 14.99, "Accesorios", 20, "disponible"),
("Reloj", "Reloj de pulsera con diseño clásico, resistente al agua hasta 50 metros. Caja de acero inoxidable con un diámetro de 40 mm, correa de cuero genuino disponible en colores negro y marrón. Movimiento de cuarzo japonés para precisión en el tiempo. Incluye función de fecha y garantía de un año.", 49.99, "Accesorios", 0, "agotado"),
("Chaqueta", "Chaqueta de cuero de alta calidad, diseñada para un ajuste perfecto y durabilidad. Forro interior de poliéster que proporciona calidez y confort. Disponible en colores negro y marrón, con cierres metálicos resistentes y bolsillos funcionales. Corte ajustado, ideal para un look moderno y elegante. Talles disponibles desde S hasta XXL.", 34.99, "Ropa", 12, "disponible"),
("Bufanda", "Bufanda de lana 100% suave y cálida, perfecta para los días fríos. Tejido de alta densidad que asegura durabilidad y resistencia. Disponible en colores gris, negro y rojo. Diseño unisex, con un largo de 180 cm que permite múltiples estilos de uso. Ideal para combinar con cualquier atuendo de invierno.", 9.99, "Ropa", 18, "disponible"),
("Vestido", "Vestido de fiesta confeccionado en tela de seda con detalles en encaje, diseñado para destacar en eventos especiales. Ajuste ceñido con escote en V y espalda descubierta. Disponible en colores rojo, azul y negro. Talles desde XS hasta XL. Ideal para bodas, cócteles y otras celebraciones formales.", 29.99, "Ropa", 0, "agotado"),
("Zapatillas", "Zapatillas de running ligeras, diseñadas para ofrecer el máximo rendimiento y comodidad. Tecnología de amortiguación en la suela que reduce el impacto en cada pisada. Tejido transpirable de malla, disponible en colores negro, azul y blanco. Talles desde 36 hasta 44. Ideales para entrenamientos y carreras de larga distancia.", 44.99, "Calzado", 10, "disponible");

-- INSERT INTO cart 
-- (user_id, product_id, quantity) VALUES
-- (1, 1, 2),
-- (2, 2, 1),
-- (3, 3, 3),
-- (4, 4, 2);

INSERT INTO images 
(product_id, image_url, alt_text, width, height) VALUES
(1, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/camisa-algodon', 'Camisa de algodón', 500, 500),
(2, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/jeans-hombre', 'Jeans para hombre', 500, 500),
(3, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/zapatos-cuero', 'Zapatos de cuero', 500, 500),
(4, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/bolso-cuero', 'Bolso de cuero', 500, 500),
(5, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/gafas-sol', 'Gafas de sol', 500, 500),
(6, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/reloj-cuero', 'Reloj de cuero', 500, 500),
(7, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/chaqueta-cuero', 'Chaqueta de cuero', 500, 500),
(8, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/bufanda-roja', 'Bufanda roja', 500, 500),
(9, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/vestido-fiesta', 'Vestido de fiesta', 500, 500),
(10, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/zapatilla-running-azul', 'Zapatilla de running azul', 500, 500);
