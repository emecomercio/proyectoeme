<?php

namespace App\Models;

class ProductModel extends DatabaseModel
{
    public function all()
    {
        try {
            $query = "SELECT * FROM products";
            $result = $this->connection->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
        } finally {
            $this->close();
        }
    }

    public function find($id)
    {
        try {
            $query = "SELECT * FROM products WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } finally {
            $this->close();
        }
    }
}
