<?php

namespace App\Api\Controllers;

use App\Models\Seller;
use App\Models\Category;
use App\Models\Variant;

class VariantController extends Controller
{
    private $variantModel;

    public function __construct()
    {
        $this->variantModel = new Variant();
    }

    public function create(array $variant, $variantIndex, $productId)
    {
        $variantModel = new Variant();
        $createdVariant = $variantModel->create([
            'product_id' => $productId,
            'stock'  => $variant['stock'],
            'current_price'  => $variant['price'],
            'last_price' => $variant['price']
        ]);

        $variantAttributeController = new VariantAttributeController();
        $createdAttributes = [];
        foreach (json_decode($variant['attributes']) as $key  => $value) {
            if (empty($value)) {
                throw new \Exception('All attributes are required', 400);
            }
            $createdAttributes[] = $variantAttributeController->create([
                'name' =>  $key,
                'value' => $value,
                'variant_id' => $createdVariant->id
            ]);
        }

        $imageController = new ImageController();
        $images = $_FILES['images'];
        if (empty($images['name'][$variantIndex])) {
            throw new \Exception('At least one image is required', 400);
        }
        $createdImages = [];
        foreach ($images['name'][$variantIndex] as  $imageIndex => $imageName) {
            $createdImages[] = $imageController->create([
                'images' => $images,
                'variantIndex' => $variantIndex,
                'imageIndex' => $imageIndex,
                'productId'  => $productId,
                'variantId' => $createdVariant->id,
                'alt' => $variant['alt'][$imageIndex]
            ]);
        }
        $createdVariant->attributes = $createdAttributes;
        $createdVariant->images = $createdImages;
        return $variant;
    }

    public function find(int $id)
    {
        $variant = $this->variantModel->find($id);
        $variant->images = $variant->getImages();
        $parent = $variant->getProduct();

        $this->respondWithSuccess(["variant" => $variant, "parent" => $parent, "variantIndex" => $variant->getIndex()]);
    }
}
