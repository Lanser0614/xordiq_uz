<?php

namespace App\Http\Controllers\Api\Admin\Category;

use App\DTOs\Category\StoreCategoryDTO;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\UseCases\Admin\Category\DeleteCategoryUseCase;
use App\UseCases\Admin\Category\StoreCategoryUseCase;
use App\UseCases\Admin\Category\UpdateCategoryUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends BaseApiController {
    public function getCategories(Request $request): JsonResponse {
        $categories = Category::query()->paginate($request->perPage ?? 15);

        return new JsonResponse($this->responseWithPagination($categories));
    }

    public function store(StoreCategoryRequest $request, StoreCategoryUseCase $useCase): JsonResponse {
        try {
            $useCase->execute(StoreCategoryDTO::frommArray($request->validated()));
        } catch (\Exception $exception) {
            return new JsonResponse($this->responseOnError($exception->getMessage(), $exception->getCode()), 500);
        }

        return new JsonResponse($this->responseSuccess());
    }

    public function update(int $id, UpdateCategoryRequest $request, UpdateCategoryUseCase $useCase): JsonResponse {
        try {
            $useCase->execute($id, StoreCategoryDTO::frommArray(data: $request->validated()));
        } catch (\Exception $exception) {
            return new JsonResponse($this->responseOnError($exception->getMessage(), $exception->getCode()), $exception->getCode());
        }

        return new JsonResponse($this->responseSuccess());
    }

    public function delete(int $id, DeleteCategoryUseCase $useCase) {
        try {
            $useCase->execute($id);
        } catch (\Exception $exception) {
            return new JsonResponse($this->responseOnError($exception->getMessage(), $exception->getCode()), $exception->getCode());
        }

        return new JsonResponse($this->responseOnDelete());
    }
}
