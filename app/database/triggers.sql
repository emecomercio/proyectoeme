USE tienda;

DELIMITER //
CREATE TRIGGER calculate_cart_line_price
BEFORE INSERT ON cart_lines
FOR EACH ROW
BEGIN
    -- Declaramos una variable para almacenar el precio del producto
    DECLARE product_variant_price DECIMAL(10, 2);

    -- Obtenemos el precio del producto desde la tabla 'products' usando el 'product_id' de la nueva línea de carrito
    SELECT current_price INTO product_variant_price 
    FROM product_variants
    WHERE id = NEW.variant_id;

    -- Calculamos el precio total de la línea del carrito multiplicando el precio del producto por la cantidad
    SET NEW.price = product_variant_price * NEW.quantity;
END;
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER update_user_timestamp_after_buyer_update
AFTER UPDATE ON buyers
FOR EACH ROW
BEGIN
    UPDATE users
    SET updated_at = CURRENT_TIMESTAMP
    WHERE id = NEW.id;
END//
DELIMITER ;

DELIMITER //
CREATE TRIGGER update_user_timestamp_after_seller_update
AFTER UPDATE ON sellers
FOR EACH ROW
BEGIN
    UPDATE users
    SET updated_at = CURRENT_TIMESTAMP
    WHERE id = NEW.id;
END//
DELIMITER ;
