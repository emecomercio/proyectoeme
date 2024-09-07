<?php

namespace App\Models;

use Exception;

class ProductModel extends DatabaseModel
{
    public function all()
    {
        $query =
            "SELECT 
                p.id,
                p.name,
                p.description,
                pv.id AS variant,
                pv.current_price AS price,
                pv.stock AS stock,
                va.name AS attribute_name,
                va.value AS attribute_value
            FROM 
                products p
            JOIN 
                product_variants pv ON pv.product_id = p.id
            LEFT JOIN 
                variant_attributes va ON va.variant_id = pv.id
            ";
        return $this->fetchAll($query);
    }

    public function find($id)
    {
        $query =
            "SELECT
                p.id,
                p.name,
                p.description,
                pv.id AS variant,
                pv.current_price AS price,
                pv.stock AS stock,
                va.name AS attribute_name,
                va.value AS attribute_value
            FROM
                products p
            JOIN
                product_variants pv ON pv.product_id = p.id
            LEFT JOIN
                variant_attributes va ON va.variant_id = pv.id
            WHERE
                p.id = ?
            ";
        return $this->fetchOne($query, [$id], 'i');
    }
}
