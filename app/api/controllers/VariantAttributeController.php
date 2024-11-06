<?php

namespace App\Api\Controllers;

use App\Models\VariantAttribute;

class VariantAttributeController extends Controller
{

    public function create(array $data)
    {
        $variantAttributeModel = new VariantAttribute([
            'name' => $data['name'],
            'value'  => $data['value'],
            'variant_id' => $data['variant_id']
        ]);

        return $variantAttributeModel->save();
    }
}
