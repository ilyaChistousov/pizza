<?php

namespace App\Http\Requests\Category;

use Illuminate\Validation\Rules\Unique;

class UpdateCategoryRequest extends StoreCategoryRequest
{
    protected function uniqueName(): Unique
    {
        return parent::uniqueName()->ignore($this->category->id);
    }
}
