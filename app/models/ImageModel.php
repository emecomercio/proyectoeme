<?php

namespace App\Models;

/**
 * mysqli queries
 * 
 */

class ImageModel extends DatabaseModel
{

    public function __construct($role)
    {
        parent::__construct($role);
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
}
