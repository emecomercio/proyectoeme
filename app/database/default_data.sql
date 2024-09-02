USE tienda;

INSERT INTO users (role, username, email, password_hash, document_number) VALUES
('admin', 'Anibalxyz', 'anibalboggio12.6.2006@gmail.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '56004002'),
('admin', 'Facundo', 'facundocanclini27@gmail.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '53568672'),
('admin', 'Lautaro', 'laudarosa12@gmail.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '51092749'),
('admin', 'Panquesito', 'lucaestudio14@gmail.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '58925031'),
('admin', 'MarquiñosJaker', 'marcosestudio13@gmail.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '59274910'),
('buyer', 'buyer1', 'buyer1@example.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '49860571'),
('buyer', 'buyer2', 'buyer2@example.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '49739579'),
('buyer', 'buyer3', 'buyer3@example.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '39874035'),
('buyer', 'buyer4', 'buyer4@example.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '38994764'),
('buyer', 'buyer5', 'buyer5@example.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '51002958'),
('seller', 'seller1', 'seller1@example.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '123456789'),
('seller', 'seller2', 'seller2@example.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '157891234'),
('seller', 'seller3', 'seller3@example.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '182345678'),
('seller', 'seller4', 'seller4@example.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '223456781'),
('seller', 'seller5', 'seller5@example.com', '$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6', '267890123');

INSERT INTO buyers (id, fullname, birthdate) VALUES
(6, 'John Doe', '1985-05-15'),
(7, 'Jane Smith', '1990-08-25'),
(8, 'Emily Johnson', '1982-12-30'),
(9, 'Michael Brown',  '1995-03-20'),
(10, 'Lisa White', '1988-11-05');

-- Insertar datos en la tabla sellers
INSERT INTO sellers (id, name, description, website, logo_url, mercadopago_account, paypal_account) VALUES
(11, 'Tech Store', 'Your tech solutions partner', 'https://techstore.com', 'https://techstore.com/logo.png', 'mercadopago_techstore@example.com', 'paypal_techstore@example.com'),
(12, 'Fashion Hub', 'Latest fashion trends', 'https://fashionhub.com', 'https://fashionhub.com/logo.png', 'mercadopago_fashionhub@example.com', 'paypal_fashionhub@example.com'),
(13, 'Grocery Mart', 'Fresh groceries daily', 'https://grocerymart.com', 'https://grocerymart.com/logo.png', 'mercadopago_grocerymart@example.com', 'paypal_grocerymart@example.com'),
(14, 'Book Haven', 'Books and more books', 'https://bookhaven.com', 'https://bookhaven.com/logo.png', 'mercadopago_bookhaven@example.com', 'paypal_bookhaven@example.com'),
(15, 'Home Goods', 'Everything for your home', 'https://homegoods.com', 'https://homegoods.com/logo.png', 'mercadopago_homegoods@example.com', 'paypal_homegoods@example.com');

INSERT INTO addresses (user_id, street, city, state, postal_code, country, type, description) VALUES
(1, '123 Main St', 'Anytown', 'Anystate', '12345', 'CountryA', 'home', 'Primary address for Anibalxyz'),
(1, '456 Elm St', 'Othertown', 'Otherstate', '67890', 'CountryB', 'work', 'Secondary address for Anibalxyz'),
(2, '789 Oak St', 'Differenttown', 'Differentstate', '54321', 'CountryC', 'home', 'Primary address for Facundo'),
(2, '101 Pine St', 'Newtown', 'Newstate', '09876', 'CountryD', 'work', 'Secondary address for Facundo'),
(3, '202 Maple St', 'Townsville', 'Stateland', '23456', 'CountryE', 'home', 'Primary address for Lautaro'),
(3, '303 Cedar St', 'Villagetown', 'Stateland', '34567', 'CountryF', 'work', 'Secondary address for Lautaro'),
(4, '404 Birch St', 'Metropolis', 'Citystate', '45678', 'CountryG', 'home', 'Primary address for Panquesito'),
(4, '505 Walnut St', 'Uptown', 'Citystate', '56789', 'CountryH', 'work', 'Secondary address for Panquesito'),
(5, '606 Oak St', 'Downtown', 'Capitalstate', '67890', 'CountryI', 'home', 'Primary address for MarquiñosJaker'),
(5, '707 Pine St', 'Oldtown', 'Capitalstate', '78901', 'CountryJ', 'work', 'Secondary address for MarquiñosJaker'),
(6, '808 Elm St', 'Suburbia', 'Substate', '89012', 'CountryK', 'home', 'Primary address for buyer1'),
(6, '909 Maple St', 'Edgeville', 'Substate', '90123', 'CountryL', 'work', 'Secondary address for buyer1'),
(7, '1010 Birch St', 'Farmland', 'Outstate', '01234', 'CountryM', 'home', 'Primary address for buyer2'),
(7, '1111 Walnut St', 'Countryside', 'Outstate', '12345', 'CountryN', 'work', 'Secondary address for buyer2'),
(8, '1212 Pine St', 'Parkville', 'Ruralstate', '23456', 'CountryO', 'home', 'Primary address for buyer3'),
(8, '1313 Oak St', 'Hilltown', 'Ruralstate', '34567', 'CountryP', 'work', 'Secondary address for buyer3'),
(9, '1414 Cedar St', 'Lakeside', 'Lakeview', '45678', 'CountryQ', 'home', 'Primary address for buyer4'),
(9, '1515 Maple St', 'Riverside', 'Lakeview', '56789', 'CountryR', 'work', 'Secondary address for buyer4'),
(10, '1616 Main St', 'Sunnyville', 'Brightstate', '67890', 'CountryS', 'home', 'Primary address for buyer5'),
(10, '1717 Elm St', 'Cloudtown', 'Brightstate', '78901', 'CountryT', 'work', 'Secondary address for buyer5'),
(11, '1818 Oak St', 'Greenfield', 'Growstate', '89012', 'CountryU', 'home', 'Primary address for seller1'),
(11, '1919 Pine St', 'Springfield', 'Growstate', '90123', 'CountryV', 'work', 'Secondary address for seller1'),
(12, '2020 Cedar St', 'Westville', 'Weststate', '01234', 'CountryW', 'home', 'Primary address for seller2'),
(12, '2121 Birch St', 'Easttown', 'Weststate', '12345', 'CountryX', 'work', 'Secondary address for seller2'),
(13, '2222 Walnut St', 'Centralcity', 'Centerstate', '23456', 'CountryY', 'home', 'Primary address for seller3'),
(13, '2323 Oak St', 'Northland', 'Centerstate', '34567', 'CountryZ', 'work', 'Secondary address for seller3'),
(14, '2424 Pine St', 'Southville', 'Southstate', '45678', 'CountryAA', 'home', 'Primary address for seller4'),
(14, '2525 Cedar St', 'Eastside', 'Southstate', '56789', 'CountryBB', 'work', 'Secondary address for seller4'),
(15, '2626 Birch St', 'Westside', 'Weststate', '67890', 'CountryCC', 'home', 'Primary address for seller5'),
(15, '2727 Maple St', 'Centralville', 'Weststate', '78901', 'CountryDD', 'work', 'Secondary address for seller5');

-- Teléfonos para usuarios admin
INSERT INTO phones (user_id, number) VALUES
(1, '+1234567890'),
(1, '+2345678901'),
(2, '+3456789012'),
(2, '+4567890123'),
(3, '+5678901234'),
(3, '+6789012345'),
(4, '+7890123456'),
(4, '+8901234567'),
(5, '+9012345678'),
(5, '+0123456789'),
-- Teléfonos para usuarios buyer
(6, '+1230984567'),
(6, '+2341098765'),
(7, '+3452109876'),
(7, '+4563210987'),
(8, '+5674321098'),
(8, '+6785432109'),
(9, '+7896543210'),
(9, '+8907654321'),
(10, '+9018765432'),
(10, '+0129876543'),
-- Teléfonos para usuarios seller
(11, '+1234567890'),
(11, '+2345678901'),
(12, '+3456789012'),
(12, '+4567890123'),
(13, '+5678901234'),
(13, '+6789012345'),
(14, '+7890123456'),
(14, '+8901234567'),
(15, '+9012345678'),
(15, '+0123456789');

INSERT INTO catalogs
(name) VALUES
("default")

-- INSERT INTO products 
-- (name, description, price, category, stock, state) VALUES
-- ("Camisa", "Camisa de algodón 100% de alta calidad, diseñada para ofrecer un ajuste cómodo y transpirable. Disponible en una amplia gama de colores, incluyendo blanco, azul, y negro. Cuenta con un corte clásico que se adapta a cualquier estilo. Disponible en talles S, M, L y XL. Ideal para usar tanto en el trabajo como en eventos casuales.", 19.99, "Ropa", 10, "disponible"),
-- ("Pantalón", "Pantalón de mezclilla premium, confeccionado con una mezcla de algodón y elastano que proporciona flexibilidad y durabilidad. Disponible en colores clásicos como azul oscuro, negro y gris. Corte regular fit, con bolsillos delanteros y traseros funcionales. Ideal para combinar con camisas o camisetas para un look casual o semi-formal. Talles disponibles desde 28 hasta 38.", 29.99, "Ropa", 5, "agotado"),
-- ("Zapatos", "Zapatos de cuero genuino, diseñados para brindar elegancia y confort. Disponen de una suela de goma antideslizante y un forro interno de piel suave para mayor comodidad durante todo el día. Disponibles en colores negro y marrón, perfectos para combinar con atuendos formales o casuales. Talles disponibles del 38 al 45.", 39.99, "Calzado", 20, "próximamente"),
-- ("Bolso", "Bolso de cuero auténtico con acabados artesanales, ideal para el uso diario. Cuenta con varios compartimentos internos y externos con cierre, perfectos para organizar tus pertenencias. Disponible en colores negro y marrón. Asa ajustable y desmontable para mayor versatilidad. Dimensiones: 30 cm x 25 cm x 10 cm.", 24.99, "Accesorios", 15, "disponible"),
-- ("Gafas de sol", "Gafas de sol polarizadas con protección UV400, ideales para proteger tus ojos de los rayos solares mientras mantienes un estilo moderno. Montura resistente de policarbonato, disponible en colores negro, azul y edición especial. Lentes polarizados que reducen el deslumbramiento. Incluye estuche protector y paño de limpieza.", 14.99, "Accesorios", 20, "disponible"),
-- ("Reloj", "Reloj de pulsera con diseño clásico, resistente al agua hasta 50 metros. Caja de acero inoxidable con un diámetro de 40 mm, correa de cuero genuino disponible en colores negro y marrón. Movimiento de cuarzo japonés para precisión en el tiempo. Incluye función de fecha y garantía de un año.", 49.99, "Accesorios", 0, "agotado"),
-- ("Chaqueta", "Chaqueta de cuero de alta calidad, diseñada para un ajuste perfecto y durabilidad. Forro interior de poliéster que proporciona calidez y confort. Disponible en colores negro y marrón, con cierres metálicos resistentes y bolsillos funcionales. Corte ajustado, ideal para un look moderno y elegante. Talles disponibles desde S hasta XXL.", 34.99, "Ropa", 12, "disponible"),
-- ("Bufanda", "Bufanda de lana 100% suave y cálida, perfecta para los días fríos. Tejido de alta densidad que asegura durabilidad y resistencia. Disponible en colores gris, negro y rojo. Diseño unisex, con un largo de 180 cm que permite múltiples estilos de uso. Ideal para combinar con cualquier atuendo de invierno.", 9.99, "Ropa", 18, "disponible"),
-- ("Vestido", "Vestido de fiesta confeccionado en tela de seda con detalles en encaje, diseñado para destacar en eventos especiales. Ajuste ceñido con escote en V y espalda descubierta. Disponible en colores rojo, azul y negro. Talles desde XS hasta XL. Ideal para bodas, cócteles y otras celebraciones formales.", 29.99, "Ropa", 0, "agotado"),
-- ("Zapatillas", "Zapatillas de running ligeras, diseñadas para ofrecer el máximo rendimiento y comodidad. Tecnología de amortiguación en la suela que reduce el impacto en cada pisada. Tejido transpirable de malla, disponible en colores negro, azul y blanco. Talles desde 36 hasta 44. Ideales para entrenamientos y carreras de larga distancia.", 44.99, "Calzado", 10, "disponible");

-- INSERT INTO images 
-- (product_id, image_url, alt_text, width, height) VALUES
-- (1, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/camisa-algodon', 'Camisa de algodón', 500, 500),
-- (2, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/jeans-hombre', 'Jeans para hombre', 500, 500),
-- (3, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/zapatos-cuero', 'Zapatos de cuero', 500, 500),
-- (4, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/bolso-cuero', 'Bolso de cuero', 500, 500),
-- (5, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/gafas-sol', 'Gafas de sol', 500, 500),
-- (6, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/reloj-cuero', 'Reloj de cuero', 500, 500),
-- (7, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/chaqueta-cuero', 'Chaqueta de cuero', 500, 500),
-- (8, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/bufanda-roja', 'Bufanda roja', 500, 500),
-- (9, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/vestido-fiesta', 'Vestido de fiesta', 500, 500),
-- (10, 'https://res.cloudinary.com/dtvdlk7fi/image/upload/c_auto,g_auto,h_500,w_500/zapatilla-running-azul', 'Zapatilla de running azul', 500, 500);

-- -- Insertar datos de prueba en carts
-- INSERT INTO carts (user_id, status) VALUES
-- (1, 'active'),
-- (2, 'completed'),
-- (3, 'active'),
-- (4, 'abandoned'),
-- (5, 'completed');

-- -- Insertar datos de prueba en cart_lines, el TRIGGER calculará el precio automáticamente
-- INSERT INTO cart_lines (cart_id, product_id, quantity) VALUES
-- (1, 1, 2),  -- Camisa x2
-- (1, 3, 1),  -- Zapatos x1
-- (2, 2, 1),  -- Pantalón x1
-- (2, 4, 1),  -- Bolso x1
-- (3, 7, 1),  -- Chaqueta x1
-- (4, 1, 1),  -- Camisa x1
-- (5, 6, 2);  -- Reloj x2
