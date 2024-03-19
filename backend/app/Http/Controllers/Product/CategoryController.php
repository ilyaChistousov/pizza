<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all('name')->toArray();

        return responseWithResource($categories);
    }

    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $newCategory = Category::create($request->validated());

        return responseCreated($newCategory->id);
    }

    public function show(Category $category): JsonResponse
    {
        $data = $category->only('name');

        return responseWithResource($data);
    }

    public function update(CategoryUpdateRequest $request, Category $category): JsonResponse{

        $category->update($request->validated());

        return responseOk();
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return responseOk();
    }
}
