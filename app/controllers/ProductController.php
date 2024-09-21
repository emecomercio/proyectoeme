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

    public function __construct()
    {
        $this->role = getUserRole();
        $this->productModel = new ProductModel();
        $this->catalogModel = new CartModel();
        $this->imageModel = new ImageModel();
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
            $images = $this->imageModel->getByProduct($variant['id']);
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
                $images = $this->imageModel->getByProduct($variant['id']);
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



    public function index($id, $variantNumber)
    {
        $product = $this->getVariants($id);

        // if (!empty($product['variants'])) {
        //     // Obtener un índice aleatorio dentro del rango válido
        //     $randomIndex = rand(0, count($product['variants']) - 1);
        //     // Obtener la variante aleatoria
        //     $randomVariant = $product['variants'][$randomIndex];
        // }



        $view = new View('products/show');
        $view->data = [
            "title" => $product['name'] ?? 'Default',
            "product" => $product,
            "variantNumber" => $variantNumber
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

    public function getByCatalog($catalog_id)
    {
        // Obtener todos los productos del catálogo específico
        $products = $this->productModel->getByCatalog($catalog_id);

        foreach ($products as &$product) {
            // Obtener las variantes para cada producto
            $variants = $this->productModel->getVariants($product['id']);

            foreach ($variants as &$variant) {
                // Obtener los atributos de la variante
                $attributes = $this->productModel->getVariantAttributes($variant['id']);
                $variant['attributes'] = $attributes;

                // Obtener las imágenes de la variante
                $images = $this->imageModel->getByVariant($variant['id']);
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

        return $products;
    }



    public function showCatalog($catalog_id)
    {
        // Obtener productos del catálogo usando el método getByCatalog
        $products = $this->getByCatalog($catalog_id);

        // Crear la vista con los productos obtenidos
        $view = new View('catalogs/show');  // Cargar la vista 'catalogs/show.php'

        // Asignar los datos a la vista
        $view->data = [
            "title" => "Catálogo de Productos",
            "products" => $products
        ];

        // Establecer las hojas de estilo necesarias
        $view->styles = [
            "pages/catalog"
        ];

        // Renderizar la vista y devolver el resultado
        return $view->render();
    }
}
