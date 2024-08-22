<?php

namespace App\Models;

use App\Models\DatabaseModel;

class ImageModel extends DatabaseModel
{


    public function getImagesByProductId($productId)
    {
        $query = "SELECT * FROM images WHERE product_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getImageBySize($productId, $width, $height)
    {
        $query = "SELECT * FROM images WHERE product_id = ? AND width = ? AND height = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("iii", $productId, $width, $height);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
