<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController
{
    public function index(Request $request)
    {
        $categories = Category::all()->toArray();

        return new CategoryResource($categories);
    }

    public function show(string $id)
    {
        if (!$category = Category::find($id)) {
            return response()->json(
                [
                    'error' => 'Category not found',
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        return new CategoryResource($category->toArray());
    }

    public function store(StoreUpdateCategoryRequest $request)
    {
        $category = Category::create($request->only('title'));

        return new CategoryResource($category->toArray());
    }

    public function update(StoreUpdateCategoryRequest $request, string $category)
    {
        $data = Category::find($category);

        if (!$data) {
            return response()->json(
                [
                    'error' => 'Category not found',
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $data->update($request->only('title'));

        return new CategoryResource($data->toArray());
    }

    public function destroy(string $category)
    {
        if (!$data = Category::find($category)) {
            return response()->json(
                [
                    'error' => 'Category not found',
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $data->delete($category);

        return response()->json(
            [],
            Response::HTTP_NO_CONTENT
        );
    }
}
