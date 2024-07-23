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

INSERT INTO users VALUES
(1, "admin", "Anibal Boggio", "anibalboggio12.6.2006@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-06-12"),
(2, "admin", "Facundo Canclini", "facundocanclini27@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-07-28"),
(3, "admin", "Lautaro da Rosa", "laudarosa12@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-07-19"),
(4, "admin", "Luca Gómez", "lucaestudio14@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-08-16"),
(5, "admin", "Marcos Muñoz", "marcosestudio13@gmail.com", "$2y$10$UlzvPXndnzCa73DtSaeQa.ddfcgEeYugh04aFOl2fLnx2zKSLN4F6", "2006-09-23");
