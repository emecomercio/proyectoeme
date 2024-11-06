<?php

namespace App\Models;

/**
 * mysqli queries
 * 
 */

class ImageModel extends DatabaseModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $query = "SELECT * FROM images";
        return $this->fetchAll($query);
    }

    public function find($id)
    {
        $query = "SELECT * FROM images WHERE id ?";
        return $this->fetchOne($query, [$id], 'i');
    }

    public function getByProduct($id)
    {
        $query = "SELECT * FROM images WHERE variant_id = ?";
        return $this->fetchAll($query, [$id], 'i');
    }

    public function getByVariant($variant_id)
    {
        $query = "SELECT src, alt, width, height FROM images WHERE variant_id = ?";
        return $this->fetchAll($query, [$variant_id], 'i');
    }
}
