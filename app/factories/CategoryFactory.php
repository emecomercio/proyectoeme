<?php

namespace App\Factories;

use Faker\Factory as Faker;
use App\Models\Category;
use App\Models\CategoryKeyword;

class CategoryFactory
{
    private static $faker;
    private static $categoryModel;
    private static $keywordModel;
    private static $isSetted = false;

    public static function setProperties()
    {
        if (self::$isSetted) {
            return;
        }
        self::$faker = Faker::create();
        self::$categoryModel = new Category();
        self::$keywordModel = new CategoryKeyword();
        self::$isSetted = true;
    }

    public static function createCategories()
    {
        $categoryNames = [
            'Tecnología' => ['Electrónica', 'Software', 'Hardware', 'Redes', 'Seguridad', 'Robótica', 'Inteligencia artificial', 'Celular'],
            'Hogar' => ['Decoración', 'Jardinería', 'Muebles', 'Electrodomésticos', 'Iluminación', 'Cocina', 'Baño'],
            'Jardín' => ['Plantas', 'Floristería', 'Jardinería', 'Pájaros', 'Riego', 'Abonos',],
            'Camping' => ['Acampada', 'Senderismo', 'Carpas', 'Equipo', 'Ropa', 'Alimentos'],
            'Deportes' => ['Fútbol', 'Baloncesto', 'Tenis', 'Golf', 'Ciclismo', 'Natación'],
            'Música' => ['Instrumentos', 'Canciones', 'Conciertos', 'Festivales', 'Géneros', 'Compositores'],
            'Arte' => ['Pintura', 'Escultura', 'Fotografía', 'Diseño', 'Arquitectura', 'Museos'],
            'Escuela' => ['Libros', 'Cuadernos', 'Útiles', 'Uniformes', 'Materias', 'Profesores'],
        ];

        foreach ($categoryNames as $categoryName => $keywords) {
            $category = self::$categoryModel->create(
                [
                    'name' => $categoryName,
                ]
            );

            foreach ($keywords as $keyword) {
                self::$keywordModel->create([
                    'category_id' => $category->id,
                    'keyword' => $keyword,
                ]);
            }
        }
    }
}
