<?php

namespace App\Models;

class CatalogModel extends DatabaseModel
{

    public function all()
    {
        $query = "SELECT * FROM catalogs";
        return $this->fetchAll($query);
    }

    public function find($id)
    {
        $query = "SELECT * FROM catalogs WHERE id = ?";
        return $this->fetchOne($query, [$id], 'i');
    }
}
