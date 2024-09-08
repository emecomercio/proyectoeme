<?php

namespace App\Models;

class CatalogModel extends DatabaseModel
{

    public function all()
    {
        $query = "SELECT * FROM catalogs";
        return $this->fetchAll($query);
    }
}
