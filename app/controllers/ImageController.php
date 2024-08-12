<?php
require_once MODELS . 'ImageModel.php';

class ImageController
{
    public static function getImagesByProduct($productId)
    {
        $imageModel = new ImageModel();
        return $imageModel->getImagesByProductId($productId);
    }

    public static function getImageBySize($productId, $width, $height)
    {
        $imageModel = new ImageModel();
        return $imageModel->getImageBySize($productId, $width, $height);
    }
}
