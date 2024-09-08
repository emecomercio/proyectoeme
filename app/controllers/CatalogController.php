<?php

namespace App\Controllers;

use App\Models\CatalogModel;

class CatalogController extends BaseController
{

    protected $catalogModel;

    public function __construct()
    {
        parent::__construct();
        $this->catalogModel = new CatalogModel(getUserRole());
    }

    public function index()
    {
        $catalogs = $this->catalogModel->all();
    }
}
