<?php

namespace App\Controllers;

use App\Models\SellerModel;
use Lib\View;
use App\Models\UserModel;

class SellerController extends BaseController
{
    protected $userModel;
    protected $sellerModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->sellerModel = new SellerModel();
    }

    public function showUploadProduct()
    {
        $view = new View('seller/upload-product');
        $view->styles = [
            '/css/pages/upload-product.css'
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
        $view = new View('seller/settings');
        $view->styles = [
            '/css/pages/settings.css'
        ];
        $view->render();
    }
}
