<?php

namespace App\Controllers;

use Lib\View;
use App\Models\CatalogModel;
use App\Models\ProductModel;

class CatalogController extends BaseController
{

    protected $catalogModel;
    protected $productController;

    public function __construct()
    {
        parent::__construct();
        $this->catalogModel = new CatalogModel();
        $this->productController = new ProductController();
    }

    public function all()
    {
        return $this->catalogModel->all();
    }

    public function find($id)
    {
        return  $this->catalogModel->find($id);
    }

    public function index($catalog_id)
    {
        $products = $this->productController->getByCatalog($catalog_id);
        $catalogs = $this->catalogModel->all();
        $catalog = $this->find($catalog_id);

        // Crear la vista con los productos obtenidos
        $view = new View('catalogs/show');  // Cargar la vista 'catalogs/show.php'
        // Asignar los datos a la vista
        $view->data = [
            "title" => $catalog['name'] . " | EME Comercio",
            "catalog" => $catalog,
            "catalogs"  => $catalogs,
            "products" => $products
        ];

        // Establecer las hojas de estilo necesarias
        $view->styles = [
            "/css/pages/catalog.css"
        ];

        $view->scripts = [
            [
                "type" => "module",
                "src" => "/js/pages/catalog.js"
            ]
        ];

        // Renderizar la vista y devolver el resultado
        return $view->render();
    }
}
