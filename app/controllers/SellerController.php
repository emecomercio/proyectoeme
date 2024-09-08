<?php

namespace App\Controllers;

use App\Models\SellerModel;
use Lib\View;
use App\Models\UserModel;

class SellerController extends BaseController
{
    protected $userModel;
    protected $sellerModel;

    public function __construct($role)
    {
        parent::__construct($role);
        $this->userModel = new UserModel($role);
        $this->sellerModel = new SellerModel($role);
    }

    public function showUploadProduct()
    {
        $view = new View('seller/upload-product', 'seller');
        $view->styles = [
            'pages/upload-product'
        ];
        $view->scripts = [
            [
                'type' => 'module',
                'src' => '/js/pages/upload_product.js'
            ]
        ];
        $view->render();
    }

    public function showSettings()
    {
        $view = new View('seller/settings', 'seller');
        $view->styles = [
            'pages/settings'
        ];
        $view->render();
    }
}
