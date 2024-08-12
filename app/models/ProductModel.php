<?php
require_once(MODELS . "DatabaseModel.php");

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
}
