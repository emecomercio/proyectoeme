<?php

namespace App\Models;

use Exception;

class ProductModel extends DatabaseModel
{
    public function all()
    {
        $query = "SELECT * FROM products";
        return $this->fetchAll($query);
    }
    public function find($id)
    {
        $query = "SELECT * FROM products WHERE id = ?";
        return $this->fetchOne($query, [$id], 'i');
    }

    public function getByCatalog($catalog_id)
    {
        $query = "SELECT * FROM products WHERE catalog_id = ?";
        return $this->fetchAll($query, [$catalog_id], 'i');
    }

    public function getVariants($product_id)
    {
        $query = "
        SELECT pv.id as id, pv.current_price, pv.last_price, pv.stock, d.value as discount
        FROM product_variants pv
        LEFT JOIN discounts d ON pv.discount_id = d.id
        WHERE pv.product_id = ?
        ";
        return $this->fetchAll($query, [$product_id], 'i');
    }

    public function getVariantAttributes($variant_id)
    {
        $query = "SELECT name, value FROM variant_attributes WHERE variant_id = ?";
        return $this->fetchAll($query, [$variant_id], 'i');
    }

    public function getAllBySeller($id)
    {
        $query = "SELECT * FROM products WHERE seller_id = ?";
        return $this->fetchAll($query, [$id], 'i');
    }

    public function create($data)
    {
        $query = "INSERT INTO products (catalog_id, seller_id, name, description) VALUES (?,?,?,?)";
        return $this->executeQuery($query, [$data['catalog-id'], $data['seller-id'], $data['name'], $data['description']], "iiss");
    }
}
