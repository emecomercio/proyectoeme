<?php

namespace App\Models;

use Exception;

class ProductModel extends DatabaseModel
{
    public function all()
    {
        $query =
            "SELECT 
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
                images i ON i.variant_id = pv.id
            ";
        return $this->fetchAll($query);
    }

    public function find($id)
    {
        $query =
            "SELECT 
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
                images i ON i.variant_id = pv.id
            WHERE
                p.id = ?
            ";
        return $this->fetchOne($query, [$id], 'i');
    }

    public function getByCatalog($id)
    {
        $query =
            "SELECT 
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
                images i ON i.variant_id = pv.id
                WHERE
                    p.catalog_id = ?
                ";
        return $this->fetchAll($query, [$id], 'i');
    }
}
