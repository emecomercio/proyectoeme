<?php

namespace App\Api\Controllers;

use App\Models\CartModel;

class CartController
{
    protected $cartModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
    }


    public function index()
    {
        $products = $this->cartModel->all();

        header('Content-Type: application/json');

        echo json_encode($products);
    }

    public function find($id)
    {
        // Obtener la información del carrito
        $cart = $this->cartModel->find($id);

        // Obtener las líneas del carrito
        $lines = $this->cartModel->getLines($id);

        // Combinar la información en un solo array
        $result = [
            'cart' => [
                'cart_id' => $cart['cart_id'],
                'username' => $cart['username'],
                'status' => $cart['status'],
            ],
            'lines' => $lines
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
