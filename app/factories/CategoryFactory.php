<?php

namespace App\Factories;

use Faker\Generator;
use App\Models\Category;
use App\Models\CategoryKeyword;

class CategoryFactory
{
    private $faker;
    private $categoryModel;
    private $keywordModel;

    public function __construct(Generator $faker, Category $categoryModel, CategoryKeyword $keywordModel)
    {
        $this->faker = $faker;
        $this->categoryModel = $categoryModel;
        $this->keywordModel = $keywordModel;
    }

    public function createCategories()
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
            $category = $this->categoryModel->create(
                [
                    'name' => $categoryName,
                ]
            );

            foreach ($keywords as $keyword) {
                $this->keywordModel->create([
                    'category_id' => $category->id,
                    'keyword' => $keyword,
                ]);
            }
        }
    }
}
