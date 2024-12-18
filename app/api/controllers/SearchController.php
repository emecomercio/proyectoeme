<?php

namespace App\Api\Controllers;

use App\Models\Category;
use App\Models\CategoryKeyword;
use Lib\RedisService;
use App\Models\Product;
use App\Models\Seller;
use Dotenv\Loader\Loader;

class SearchController extends Controller
{
    private $productModel;
    private $sellerModel;
    private $categoryModel;
    private $keywordModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->sellerModel = new Seller();
        $this->categoryModel = new Category();
        $this->keywordModel = new CategoryKeyword();
    }

    public function index()
    {
        $query = isset($_GET['query']) ? trim($_GET['query']) : '';
        if (empty($query)) {
            throw new \Exception('Query is empty', 400);
        }

        if (empty($_ENV["REDIS_HOST"]) || empty($_ENV["REDIS_PORT"])) {
            $results = $this->performSearch($query);
            $this->respondWithSuccess($results, "Results fetched from database");
        }

        $redis = RedisService::getClient();

        $cacheKey = 'search:' . md5($query);
        $cachedResults = $redis->get($cacheKey);

        if ($cachedResults) {
            $this->respondWithSuccess(json_decode($cachedResults), 'Results fetched from cache');
        }

        $results = $this->performSearch($query);

        $redis->setex($cacheKey, 3600, json_encode($results));

        $this->respondWithSuccess($results, "Results fetched from database");
    }

    private function performSearch($query): array
    {
        $products = $this->productModel->all(false);
        $keywords = explode(' ', strtolower($query));

        $productScores = [];
        foreach ($products as $product) {
            $sellerName = $this->sellerModel->find($product['seller_id'])->name;
            $category = $this->categoryModel->find($product['category_id']);
            $variants = $this->productModel->getVariantsById($product['id'], false);

            $categoryKeywords = $category->getKeywords(true);

            $searchableText = strtolower($product['name'] . ' ' . $sellerName . ' ' . $categoryKeywords);
            $searchableDesc = strtolower($product['description'] ?? "");

            $wordsInText = explode(" ", $searchableText);
            $wordsInDesc = explode(" ", $searchableDesc);

            $score = 0;
            foreach ($keywords as $keyword) {
                $score += $this->calculateMatchScore($keyword, $wordsInDesc, 1);

                $score += $this->calculateMatchScore($keyword, $wordsInText, 5);
            }

            if ($score > 0 && isset($variants[0])) {
                $productScores[] = [
                    'product' => (object) [
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'sellerName' => $sellerName,
                        'currentPrice' => (float) $variants[0]['current_price'],
                        'lastPrice' => (float) $variants[0]['last_price'],
                        'image' => $variants[0]['image'],
                    ],
                    'score'   => $score
                ];
            }
        }
        // Ordenar los productos por puntaje (de mayor a menor)
        usort($productScores, function ($a, $b) {
            return $b['score'] - $a['score'];
        });

        // Extraer solo los productos del array ordenado
        $sortedProducts = [];
        foreach ($productScores as $entry) {
            $sortedProducts[] = $entry['product']; // Solo extraemos los productos
        }

        // Devolver los productos ordenados
        return $sortedProducts;
    }

    private function calculateMatchScore($keyword, $words, $weight = 1): float
    {
        $score = 0;
        foreach ($words as $word) {
            $distance = levenshtein($keyword, $word);

            if ($distance === 0) {
                $score += 15 * $weight;
            } elseif ($distance <= 1) {
                $score += 10 * $weight;
            } elseif ($distance <= 2) {
                $score += 5 * $weight;
            } elseif ($distance <= 3) {
                $score += 1 * $weight;
            } elseif ($distance <= 5) { // Para que sume algun punto y no salgan 0 elementos, recomendado sacar en produccion
                $score += 0.3 * $weight;
            }
        }

        return $score;
    }
}
