<?php

namespace App\Api\Controllers;

use App\Models\Cart;
use App\Models\CartLine;
use App\Models\User;

class CartController extends Controller
{
    private $cartModel;
    private $lineModel;
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->cartModel = new Cart();
        $this->lineModel = new CartLine();
        $this->userModel = new User();
    }

    public  function index()
    {
        $data = $this->verifyToken();

        $user = $this->userModel->find($data->user_id);

        $cart = $user->getCurrentCart();

        $this->respondWithSuccess(['cart' => $cart]);
    }

    public function addLine()
    {
        $productData = $this->getInput();
        $token = $this->verifyToken();

        $user = $this->userModel->find($token->user_id);
        $cart = $user->getCurrentCart();

        $variant = $productData['variant'];
        $quantity = $productData['quantity'];

        $price = $quantity * $variant['current_price'];

        $result = [
            'cart_id' => $cart->id,
            'variant_id' => $variant['id'],
            'quantity' => $quantity,
            'price' => number_format($price, 2, '.', ''),
        ];
        $line =  new CartLine($result);
        $result = $line->save();
        // $cart->setLine($line);
        // $result = $cart->save();

        $this->respondWithSuccess($result);
    }

    public function create()
    {
        $data = $this->getInput();
        $user = $this->userModel->find($data['user_id']);
        $cart = $this->cartModel->create([
            'user_id' => $user->id
        ]);
    }
}
