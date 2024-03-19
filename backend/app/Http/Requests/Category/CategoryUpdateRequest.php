<?php

namespace App\Http\Requests\Category;

use Illuminate\Validation\Rules\Unique;

class CategoryUpdateRequest extends CategoryStoreRequest
{
    protected function uniqueName(): Unique
    {
        return parent::uniqueName()->ignore($this->category->id);
    }
}
