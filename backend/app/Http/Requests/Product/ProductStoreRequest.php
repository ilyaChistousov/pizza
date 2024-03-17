<?php

namespace App\Http\Requests\Product;

use App\Enums\ProductCategory;
use App\Enums\ProductSize;
use App\Models\Product;
use App\Services\Product\DTO\NewProductDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class ProductStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:100', $this->uniqueName()],
            'category' => ['required', 'string', 'exists:categories,name'],
            'description' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image'],
            'price' => ['required', 'array'],
            'price.*.size' => ['required', 'string', Rule::in(ProductSize::cases())],
            'price.*.price' => ['required', 'numeric', 'gt:0'],
        ];
    }

    protected function uniqueName(): Unique
    {
        return Rule::unique(Product::class, 'name',);
    }

    public function dto(): NewProductDTO
    {
        return NewProductDTO::from($this->validated());
    }
}
