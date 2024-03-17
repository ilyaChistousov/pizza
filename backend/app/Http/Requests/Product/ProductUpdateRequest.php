<?php

namespace App\Http\Requests\Product;

use Illuminate\Validation\Rules\Unique;

class ProductUpdateRequest extends ProductStoreRequest
{
    protected function uniqueName(): Unique
    {
        return parent::uniqueName()->ignore($this->product->id);
    }
}
