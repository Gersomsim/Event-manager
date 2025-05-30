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
use App\Const\CategoryStatus;
use App\Exceptions\BadRequestException;

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

    public function discontinue(Category $category)
    {
        if ($category->status === CategoryStatus::DISCONTINUED) {
            throw new BadRequestException('Category already discontinued');
        }
        return $this->updateElement($category, ['status' => CategoryStatus::DISCONTINUED], CategoryResource::class);
    }

    public function reactivate(Category $category)
    {
        if ($category->status === CategoryStatus::ACTIVE) {
            throw new BadRequestException('Category already active');
        }
        return $this->updateElement($category, ['status' => CategoryStatus::ACTIVE], CategoryResource::class);
    }
}
