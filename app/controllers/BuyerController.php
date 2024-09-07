<?php

namespace App\Controllers;

use Lib\View;

class BuyerController extends BaseController
{

    public function showFavorites()
    {
        $favorites = new View('buyer/favorites', 'buyer');
        $favorites->styles = [
            "pages/favorites"
        ];
        $favorites->render();
    }

    public function showShopingHistory()
    {
        $shopHistory = new View('buyer/shopping-history', 'buyer');
        $shopHistory->styles = [
            "pages/shopping-history"
        ];
        $shopHistory->render();
    }

    public function showSearchHistory()
    {
        $searchHistory = new View('buyer/search-history', 'buyer');
        $searchHistory->styles = [
            "pages/search-history"
        ];
        $searchHistory->render();
    }
}
