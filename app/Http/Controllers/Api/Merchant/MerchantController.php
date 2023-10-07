<?php

namespace App\Http\Controllers\Api\Merchant;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Exceptions\DataBaseException;
use App\DTOs\Merchant\StoreMerchantDTO;
use App\DTOs\Merchant\UpdateMerchantDTO;
use App\UseCases\Merchant\ShowMerchantUseCase;
use App\Exceptions\DtoException\ParseException;
use App\UseCases\Merchant\StoreMerchantUseCase;
use App\UseCases\Merchant\DeleteMerchantUseCase;
use App\UseCases\Merchant\UpdateMerchantUseCase;
use App\Http\Requests\Merchant\StoreMerchantRequest;
use App\UseCases\Merchant\UserMerchantsIndexUseCase;
use App\Http\Requests\Merchant\UpdateMerchantRequest;
use App\UseCases\Merchant\SetCategoryForMerchantUseCase;
use App\Http\Controllers\BaseApiController\BaseApiController;

class MerchantController extends BaseApiController
{
    /**
     * @throws DataBaseException
     * @throws ParseException
     */
    public function store(StoreMerchantRequest $request, StoreMerchantUseCase $useCase): JsonResponse
    {
        $useCase->execute(merchantUser: auth()->user(), DTO: StoreMerchantDTO::frommArray($request->validated()));

        return new JsonResponse($this->responseSuccess());
    }

    public function index(
        Request $request,
        UserMerchantsIndexUseCase $useCase
    ): JsonResponse {
        $merchants = $useCase->execute(auth()->user(), $request->input('prePage') ?? 15, $request->input('page') ?? 1);

        return new JsonResponse($this->responseWithPagination($merchants));
    }

    public function show(int $id, ShowMerchantUseCase $useCase): JsonResponse
    {
        $merchant = $useCase->execute($id, auth()->user());

        return new JsonResponse($this->responseOneItem($merchant));
    }

    /**
     * @throws DataBaseException
     * @throws ParseException
     */
    public function update(int $id, UpdateMerchantRequest $request, UpdateMerchantUseCase $useCase): JsonResponse
    {
        $useCase->execute($id, auth()->user(), UpdateMerchantDTO::frommArray($request->validated()));

        return new JsonResponse($this->responseSuccess());
    }

    public function delete(int $id, DeleteMerchantUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id, auth()->user());
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

        return new JsonResponse($this->responseOnDelete());
    }

    public function setCategory(int $id, int $category_id, SetCategoryForMerchantUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id, $category_id);
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

        return new JsonResponse($this->responseSuccess());
    }
}
