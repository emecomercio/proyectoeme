USE ecommerce;


SELECT * FROM users;
SELECT * FROM buyers;
SELECT * FROM sellers;
SELECT * FROM phones;
SELECT * FROM addresses;
SELECT * FROM carts;
SELECT * FROM cart_lines;
SELECT * FROM images;
SELECT * FROM discounts;
SELECT * FROM catalogs;
SELECT * FROM products;
SELECT * FROM product_variants;
SELECT * FROM variant_attributes;
-- SELECCIONAR TODOS LOS BUYERS Y TODOS SUS DATOS
SELECT
    u.id,
    u.role,
    u.username,
    u.email,
    u.document_number,
    u.active,
    u.created_at,
    u.updated_at,
    b.fullname AS buyer_fullname,
    b.birthdate AS buyer_birthdate
FROM
    users u
INNER JOIN
    buyers b ON u.id = b.id;

-- SELECCIONAR TODOS LOS SELLERS Y TODOS SUS DATOS
SELECT
    u.id,
    u.role,
    u.username,
    u.email,
    u.document_number,
    u.active,
    u.created_at,
    u.updated_at,
    u.name AS seller_name,
    s.description AS seller_description,
    s.website AS seller_website,
    s.logo_url AS seller_logo_url,
    s.mercadopago_account AS seller_mercadopago_account,
    s.paypal_account AS seller_paypal_account
FROM
    users u
INNER JOIN
    sellers s ON u.id = s.id;

-- SELECCIONAR TODOS LOS USERS Y TODOS SUS DATOS
SELECT
    u.id,
    u.role,
    u.username,
    u.email,
    u.document_number,
    u.password_hash,
    u.active,
    u.created_at,
    u.updated_at,
    b.fullname AS buyer_fullname,
    b.birthdate AS buyer_birthdate,
    s.name AS seller_name,
    s.description AS seller_description,
    s.website AS seller_website,
    s.logo_url AS seller_logo_url,
    s.mercadopago_account AS seller_mercadopago_account,
    s.paypal_account AS seller_paypal_account
FROM
    users u
LEFT JOIN
    buyers b ON u.id = b.id
LEFT JOIN
    sellers s ON u.id = s.id;

-- SELECCIONAR TODAS LAS ADDRESSES DE TODOS LOS USERS
SELECT 
	u.username,
    a.id AS address_id,
    a.street,
    a.city,
    a.state,
    a.postal_code,
    a.country,
    a.type AS address_type,
    a.description AS address_description
FROM 
    addresses a
JOIN 
    users u ON a.user_id = u.id;

-- TODOS LOS PRODUCTOS CON SU INFORMACION --

SELECT 
    p.id AS product_id,
    p.name AS name,
    p.description AS description,
    p.catalog_id AS catalog_id,
    pv.id AS variant_id,
    pv.current_price AS current_price,
    pv.last_price AS last_price,
    pv.stock AS variant_stock,
    va.name AS attribute_name,
    va.value AS attribute_value,
    i.image_url AS image_url,
    i.alt_text AS image_alt_text,
    i.width AS image_width,
    i.height AS image_height
FROM 
    products p
JOIN 
    product_variants pv ON pv.product_id = p.id
LEFT JOIN 
    variant_attributes va ON va.variant_id = pv.id
LEFT JOIN 
    images i ON i.variant_id = pv.id;
