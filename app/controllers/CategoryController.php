<?php

namespace App\Controllers;

use Lib\View;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    public $productModel;
    public $categoryModel;

    public function __construct()
    {
        parent::__construct();
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    public function index($category_id)
    {
        $category = $this->categoryModel->find($category_id);
        $products = $category->getProducts();

        // Crear la vista con los productos obtenidos
        $view = new View('catalogs/show');  // Cargar la vista 'catalogs/show.php'
        // Asignar los datos a la vista
        $view->data = [
            "title" => $category->name,
            "category" => $category,
            "products" => $products
        ];

        // Establecer las hojas de estilo necesarias
        $view->styles = [
            "/css/pages/catalog.css"
        ];

        $view->scripts = [];

        // Renderizar la vista y devolver el resultado
        return $view->render();
    }
}
