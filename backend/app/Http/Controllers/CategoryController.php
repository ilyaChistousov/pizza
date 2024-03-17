<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all('name')->toArray();

        return responseWithResource($categories);
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $newCategory = Category::create($request->validated());

        return responseCreated($newCategory->id);
    }

    public function show(Category $category): JsonResponse
    {
        $data = $category->only('name');

        return responseWithResource($data);
    }

    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse{

        $category->update($request->validated());

        return responseOk();
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return responseOk();
    }
}
