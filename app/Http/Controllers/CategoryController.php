<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Http\Traits\ObjectManipulation;
use App\Http\Traits\ResponseIndex;
use App\Http\Traits\SuccessResponse;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    use ObjectManipulation, ResponseIndex, SuccessResponse;
    public function index(Request $request)
    {
        $filters = [
            'query' => ['slug'],
            'like' => ['name', 'description']
        ];
        return $this->getIndex($request, Category::class, $filters, 'id', 'desc', CategoryResource::class);
    }

    public function store(StoreCategoryRequest $request)
    {
        return $this->createElement(Category::class, $request->validated(), CategoryResource::class);
    }

    public function show(Category $category)
    {
        return $this->response(CategoryResource::make($category));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        return $this->updateElement($category, $request->validated(), CategoryResource::class);
    }

    public function destroy(Category $category)
    {
        return $this->deleteElement($category, CategoryResource::class);
    }
}
