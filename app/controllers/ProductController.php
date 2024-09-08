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
        // Obtener el producto para el ID dado
        $product = $this->productModel->find($id); // Método hipotético para obtener el producto

        if (!$product) {
            return null; // O manejar el caso donde el producto no existe
        }

        // Obtener variantes para el producto actual
        $variants = $this->productModel->getVariants($id);

        // Obtener imágenes para cada variante
        foreach ($variants as &$variant) {
            $images = $this->imageModel->getByProduct($variant['variant_id']);
            $i = 0;
            foreach ($images as $image) {
                $width = $image['width'];
                $height = $image['height'];
                $variant['images'][($width . 'x' . $height)][$i]['src'] = $image['src'];
                $variant['images'][($width . 'x' . $height)][$i]['alt'] = $image['alt'];

                $i++;
            }
        }

        // Asignar las variantes al producto
        $product['variants'] = $variants;
        return $product;
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
                $i = 0;
                foreach ($images as $image) {
                    $width = $image['width'];
                    $height = $image['height'];
                    $variant['images'][($width . 'x' . $height)][$i]['src'] = $image['src'];
                    $variant['images'][($width . 'x' . $height)][$i]['alt'] = $image['alt'];

                    $i++;
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
        $product = $this->getVariants($id);

        if (!empty($product['variants'])) {
            // Obtener un índice aleatorio dentro del rango válido
            $randomIndex = rand(0, count($product['variants']) - 1);
            // Obtener la variante aleatoria
            $randomVariant = $product['variants'][$randomIndex];
        }

        $view = new View('products/show');
        $view->data = [
            "title" => $product['name'],
            "product" => $product,
            "randomVariant" => $randomVariant
        ];
        $view->styles = [
            "pages/product-page"
        ];
        $view->scripts = [
            [
                "type" => "module",
                "src" => "/js/pages/product_page.js"
            ],
            [
                "src" => "/js/components/add_to_cart_button.js",
                "defer" => true
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
