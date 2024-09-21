USE ecommerce;

-- ROLES --
CREATE ROLE IF NOT EXISTS 'admin';
CREATE ROLE IF NOT EXISTS 'seller';
CREATE ROLE IF NOT EXISTS 'buyer';
CREATE ROLE IF NOT EXISTS 'guest';
-- USERS --
CREATE USER IF NOT EXISTS 'admin'@'localhost' IDENTIFIED BY 'admin';
CREATE USER IF NOT EXISTS 'seller'@'localhost' IDENTIFIED BY 'seller';
CREATE USER IF NOT EXISTS 'buyer'@'localhost' IDENTIFIED BY 'buyer';
CREATE USER IF NOT EXISTS 'guest'@'localhost' IDENTIFIED BY 'guest';
-- ROLES ASSIGNMENT --
GRANT 'admin' TO 'admin'@'localhost';
GRANT 'seller' TO 'seller'@'localhost';
GRANT 'buyer' TO 'buyer'@'localhost';
GRANT 'guest' TO 'guest'@'localhost';

-- ADMIN PRIVILEGES -- TEMPORAL
GRANT ALL PRIVILEGES ON ecommerce.* TO 'admin'@'localhost';

-- SELLER PRIVILEGES -- TEMPORAL
GRANT ALL PRIVILEGES ON ecommerce.* TO 'seller'@'localhost';

-- BUYER PRIVILEGES -- TEMPORAL
GRANT ALL PRIVILEGES ON ecommerce.* TO 'buyer'@'localhost';


-- GUEST PRIVILEGES --
GRANT SELECT ON ecommerce.products TO 'guest'@'localhost';
GRANT SELECT ON ecommerce.product_variants TO 'guest'@'localhost';
GRANT SELECT ON ecommerce.variant_attributes TO 'guest'@'localhost';
GRANT SELECT ON ecommerce.catalogs TO 'guest'@'localhost';
GRANT SELECT ON ecommerce.images TO 'guest'@'localhost';
GRANT SELECT ON ecommerce.discounts TO 'guest'@'localhost';
GRANT INSERT ON ecommerce.users TO 'guest'@'localhost';


-- DEFAULT ROLES --
SET DEFAULT ROLE 'admin' TO 'admin'@'localhost';
SET DEFAULT ROLE 'seller' TO 'seller'@'localhost';
SET DEFAULT ROLE 'buyer' TO 'buyer'@'localhost';
SET DEFAULT ROLE ALL TO 'guest'@'localhost';
