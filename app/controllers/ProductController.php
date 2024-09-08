<?php

namespace App\Controllers;

use Lib\View;
use App\Models\CartModel;
use App\Models\ImageModel;
use App\Models\ProductModel;

/**
 * @var array $products;
 * @var array $images;
 */

class ProductController extends BaseController
{
    protected $role;
    protected $productModel;
    protected $catalogModel;
    protected $imageModel;

    public function __construct($role)
    {
        $this->role = $role;
        $this->productModel = new ProductModel($role);
        $this->catalogModel = new CartModel($role);
        $this->imageModel = new ImageModel($role);
    }

    public function all()
    {
        $products = $this->productModel->all();
        return $products;
    }

    public function getVariants($id)
    {
        $variants = $this->productModel->getVariants($id);
        foreach ($variants as $key => $variant) {
            $images = $this->imageModel->getByProduct($variant['variant_id']);
            foreach ($images as $image) {
                $width = $image['width'];
                $height = $image['height'];
                $variants[$key]['images'][($width . 'x' . $height)]['src'][] = $image['src'];
            }
        }
        return $variants;
    }

    public function allWithVariants()
    {
        // Obtener todos los productos
        $products = $this->productModel->all();

        // Iterar sobre cada producto para obtener sus variantes
        foreach ($products as &$product) {
            // Obtener variantes para el producto actual
            $variants = $this->productModel->getVariants($product['id']);

            // Obtener imágenes para cada variante
            foreach ($variants as &$variant) {
                $images = $this->imageModel->getByProduct($variant['variant_id']);
                foreach ($images as $image) {
                    $width = $image['width'];
                    $height = $image['height'];
                    $variant['images'][($width . 'x' . $height)]['src'][] = $image['src'];
                }
            }

            // Asignar las variantes al producto
            $product['variants'] = $variants;
        }

        // Retornar productos con variantes y sus imágenes
        return $products;
    }



    public function index($id)
    {
        $product = $this->productModel->find($id);
        $view = new View('products/show');
        $view->data = [
            "title" => $product['name'],
            "product" => $product
        ];
        $view->styles = [
            "pages/product-page"
        ];
        $view->scripts = [
            [
                "type" => "module",
                "src" => "/js/main.js"
            ],
            [
                "type" => "module",
                "src" => "/js/pages/product_page.js"
            ]
        ];

        return $view->render();
    }

    public function getByCatalog($id)
    {
        $products = $this->productModel->getByCatalog($id);
        return $products;
    }

    public function showCatalog($id)
    {
        $products = $this->getByCatalog($id);
        $view = new View('catalogs/show', $this->role);
        $view->data = [
            "title" => "Catalog | EME Comercio",
            "products" => $products
        ];
        $view->styles = [
            "pages/catalog"
        ];
        $view->render();
    }
}
