<?php

namespace App\Http\Requests\Order;

use App\DTO\Order\NewOrderDTO;
use App\Enums\ProductSize;
use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;

class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['exists:users,id'],
            'phone' => ['required'],
            'address' => ['required', 'string', 'min:5', 'max:255'],
            'total' => ['required', 'numeric'],
            'products' => ['required', 'array'],
            'products.*.id' => ['required', 'exists:'.Product::class],
            'products.*.quantity' => ['required', 'numeric', 'gt:0'],
            'products.*.price' => ['required', 'numeric', 'gt:0'],
            'products.*.size' => ['required', $this->findSize()],
        ];
    }

    protected function findSize(): Exists
    {
        $productId = $this->input('products.*.id')[0];

        return Rule::exists('product_details', 'size')
            ->where('product_id', $productId);
    }

    public function dto(): NewOrderDTO
    {
        return NewOrderDTO::from($this->validated());
    }
}
