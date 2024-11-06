<?php

namespace App\Models;

class CartModel extends DatabaseModel
{
    public function all()
    {
        $query = "SELECT * FROM carts";
        $preparation = $this->prepare($query);
        $preparation->execute();
        return $preparation->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id)
    {
        $query = "
            SELECT c.id AS cart_id, u.username, c.status
            FROM carts c
            JOIN users u ON c.user_id = u.id
            WHERE c.id = ?";

        $preparation = $this->prepare($query);
        $preparation->bind_param("i", $id);
        $preparation->execute();
        return $preparation->get_result()->fetch_assoc();
    }


    public function getLines($id)
    {
        $query = "
                SELECT p.name AS product, p.price AS unit_price, cl.quantity, cl.price AS total_price
                FROM cart_lines cl
                JOIN products p ON cl.product_id = p.id
                WHERE cl.cart_id = ?";

        $preparation = $this->prepare($query);
        $preparation->bind_param("i", $id);
        $preparation->execute();
        return $preparation->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function create($data)
    {
        $query = "INSERT INTO carts (user_id) VALUES (?)";
        $this->executeQuery($query, [$data['user_id']], 'i');
    }

    public function update($data)
    {
        $query = "UPDATE carts SET status = ? WHERE id = ?";
        $this->executeQuery($query, [$data['status'], $data['id']], 'ii');
    }
}
