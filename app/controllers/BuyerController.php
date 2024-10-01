<?php

namespace App\Controllers;

use Lib\View;

class BuyerController extends BaseController
{

    public function showFavorites()
    {
        $favorites = new View('buyer/favorites');
        $favorites->styles = [
            "/css/pages/favorites.css"
        ];
        $favorites->render();
    }

    public function showShopingHistory()
    {
        $shopHistory = new View('buyer/shopping-history', 'buyer');
        $shopHistory->styles = [
            "/css/pages/shopping-history.css"
        ];
        $shopHistory->render();
    }

    public function showSearchHistory()
    {
        $searchHistory = new View('buyer/search-history', 'buyer');
        $searchHistory->styles = [
            "/css/pages/search-history.css"
        ];
        $searchHistory->render();
    }
}
