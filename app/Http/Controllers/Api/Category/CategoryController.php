<?php

namespace App\Http\Controllers\Api\Category;

use App\DTOs\Category\StoreCategoryDTO;
use App\Exceptions\DtoException\ParseException;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\UseCases\Category\DeleteCategoryUseCase;
use App\UseCases\Category\StoreCategoryUseCase;
use App\UseCases\Category\UpdateCategoryUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends BaseApiController
{
    public function getCategories(Request $request): JsonResponse
    {
        $categories = Category::query()->paginate($request->perPage ?? 15);
        return new JsonResponse($this->responseWithPagination($categories));
    }

    /**
     * @param StoreCategoryRequest $request
     * @param StoreCategoryUseCase $useCase
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request, StoreCategoryUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute(StoreCategoryDTO::frommArray($request->validated()));
        } catch (\Exception $exception){
            return new JsonResponse($this->responseOnError($exception->getMessage(), $exception->getCode()), 500);
        }

        return new JsonResponse($this->responseSuccess());
    }

    /**
     * @param int $id
     * @param UpdateCategoryRequest $request
     * @param UpdateCategoryUseCase $useCase
     * @return JsonResponse
     */
    public function update(int $id, UpdateCategoryRequest $request, UpdateCategoryUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id, StoreCategoryDTO::frommArray(data: $request->validated()));
        } catch (\Exception $exception){
            return new JsonResponse($this->responseOnError($exception->getMessage(), $exception->getCode()), $exception->getCode());
        }

        return new JsonResponse($this->responseSuccess());
    }

    public function delete(int $id, DeleteCategoryUseCase $useCase)
    {
        try {
            $useCase->execute($id);
        } catch (\Exception $exception){
            return new JsonResponse($this->responseOnError($exception->getMessage(), $exception->getCode()), $exception->getCode());
        }

        return new JsonResponse($this->responseOnDelete());
    }
}
