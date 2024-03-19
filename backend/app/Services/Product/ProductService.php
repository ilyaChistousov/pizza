<?php

namespace App\Services\Product;

use App\DTO\Product\GetProductDTO;
use App\DTO\Product\NewProductDTO;
use App\Facade\Image;
use App\Models\Category;
use App\Models\Product;

class ProductService
{
    public function index(): array
    {
        $products = Product::with(['category:id,name', 'productDetails:product_id,size,price'])->get();

        $mappedProducts = $products->map(function ($product) {
            $product->price = $product->productDetails->map(function ($detail) {
                return ['size' => $detail->size, 'price' => $detail->price];
            })->toArray();

            $product->categoryName = $product->category->name;

            return GetProductDTO::from($product);
        });

        return $mappedProducts->toArray();
    }

    public
    function store(NewProductDTO $dto): int
    {
        $newData = $dto->except('price, image')->toArray();
        $newData['image'] = Image::savePublicly($dto->image);

        $newProduct = Product::query()->create($newData);
        $newProduct->productDetails()->createMany($dto->price);

        $category = Category::query()->where('name', $dto->category)->first();
        $newProduct->category()->associate($category);
        $newProduct->save();

        return $newProduct->id;
    }

    public
    function show(Product $product): array
    {
        $data['price'] = $product->productDetails()->get(['size', 'price'])->toArray();
        $data['category'] = $product->category->name;

        return GetProductDTO::from($product, $data)->toArray();
    }

    public
    function update(NewProductDTO $dto, Product $product): void
    {
        $newData = $dto->except('price, image')->toArray();
        $newData['image'] = Image::savePublicly($dto->image);

        $product->update($newData);

        foreach ($dto->price as $price) {
            $product->productDetails()->updateOrCreate(
                ['size' => $price['size']], ['price' => $price['price']]
            );
        }

        $category = Category::query()->where('name', $dto->category)->first();
        $product->category()->associate($category);
        $product->save();
    }
}
