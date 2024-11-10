<?php

namespace App\Api\Controllers;

use App\Models\Seller;

class SellerController extends Controller
{

    private $sellerModel;
    public function __construct()
    {
        $this->sellerModel = new Seller();
    }

    public function find(int $id)
    {
        $seller = $this->sellerModel->find($id);

        $this->respondWithSuccess($seller);
    }
}
