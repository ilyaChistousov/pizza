<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

    public function index(ProductService $service): JsonResponse
    {
        $products = $service->index();

        return responseWithResource($products);
    }

    public function store(ProductStoreRequest $request, ProductService $service)
    {
        $id = $service->store($request->dto());

        return responseCreated($id);
    }

    public function show(Product $product, ProductService $service): JsonResponse
    {
        $product = $service->show($product);

        return responseWithResource($product);
    }

    public function update(
        ProductUpdateRequest $request,
        Product $product,
        ProductService $service
    ): JsonResponse
    {
        $service->update($request->dto(), $product);

        return responseOk();
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return responseOk();
    }
}
