<?php

namespace App\Models;

use App\Models\DatabaseModel;

class ProductModel extends DatabaseModel
{
    public function getAllProducts()
    {
        $query = "SELECT * FROM products";
        $result = $this->connection->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllImages()
    {
        $query = "SELECT * FROM images";
        $result = $this->connection->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getProductById($id)
    {
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
