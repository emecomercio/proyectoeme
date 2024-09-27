<?php

namespace App\Api\Controllers;

use App\Models\ImageModel;
use Exception;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $imageModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->imageModel = new ImageModel();
    }

    public function index()
    {
        try {
            $products = $this->productModel->all();
            $this->respondWithSuccess($products);
        } catch (Exception $e) {
            // Usa el método de la clase base para manejar la excepción
            $this->handleException($e, "Error retrieving products");
        }
    }

    public function find($id)
    {
        try {
            $product = $this->productModel->find($id);

            if (!$product) {
                $this->respondWithError("Product not found", 404);
            } else {
                $this->respondWithSuccess($product);
            }
        } catch (Exception $e) {
            $this->handleException($e, "Error retrieving product");
        }
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

    public function getVariantsOf($products)
    {
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

    public function getProductsBySeller($id)
    {
        $products = $this->productModel->getAllBySeller($id);
        return $this->getVariantsOf($products);
    }
}
