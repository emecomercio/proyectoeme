<?php

namespace App\Api\Controllers;

use App\Models\Image;
use App\Models\User;

class ImageController extends Controller
{

    public function create(array $data)
    {
        $sellerId =  AuthController::getToken()->id;
        $images = $data['images'];
        $variantIndex = $data['variantIndex'];
        $imageIndex = $data['imageIndex'];
        $productId = $data['productId'];
        $variantId = $data['variantId'];
        $alt = $data['alt'];



        $size = $images['size'][$variantIndex][$imageIndex];
        $tmpName = $images['tmp_name'][$variantIndex][$imageIndex];
        $fileType = $images['type'][$variantIndex][$imageIndex];
        $extension = pathinfo($images['name'][$variantIndex][$imageIndex], PATHINFO_EXTENSION);


        $src = "/uploads/products/{$sellerId}/{$productId}/{$variantIndex}_{$imageIndex}.{$extension}";
        $destination = $_SERVER['DOCUMENT_ROOT'] . $src;

        if (!file_exists(dirname($destination))) {
            mkdir(dirname($destination), 0775, true);
        }

        if (move_uploaded_file($tmpName, $destination)) {
            $imageModel = new Image();
            return $imageModel->create([
                'variant_id' => $variantId,
                'src' => $src,
                'alt' => $alt,
            ]);
        } else {
            throw new  \Exception("Failed to upload image");
        }
    }
}
