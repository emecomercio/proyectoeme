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
        $this->cartModel = new Cart();
        $this->lineModel = new CartLine();
        $this->userModel = new User();
    }

    public  function getCurrentCart()
    {
        $jwt = AuthController::getToken();

        $user = $this->userModel->find($jwt->user_id);

        $cart = $user->getCurrentCart();

        $cart->lines = $cart->getLines();

        $this->respondWithSuccess(['cart' => $cart]);
    }

    public function addLine()
    {
        $productData = $this->getInput();
        $jwt = AuthController::getToken();

        $user = $this->userModel->find($jwt->user_id);
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

        $this->respondWithSuccess($result);
    }

    public function deleteLine(int $id)
    {
        $jwt = AuthController::getToken();

        $user = $this->userModel->find($jwt->user_id);
        $userCart = $user->getCurrentCart();
        $line = $this->lineModel->find($id);
        $lineCart = $line->getCart();

        if ($lineCart->id !== $userCart->id) {
            throw new \Exception('You are not allowed to delete this line', 403);
        }

        $line->delete();


        $this->respondWithSuccess($id);
    }

    public function closeCart()
    {
        $jwt = AuthController::getToken();

        //Validaciones necesarias

        // Setear current cart en 1

        $this->respondWithSuccess($jwt);
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
