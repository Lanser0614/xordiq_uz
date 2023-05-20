<?php

namespace App\Http\Controllers\Api\Merchant;

use App\DTOs\Merchant\StoreMerchantDTO;
use App\DTOs\Merchant\UpdateMerchantDTO;
use App\Exceptions\DataBaseException;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Merchant\StoreMerchantRequest;
use App\Http\Requests\Merchant\UpdateMerchantRequest;
use App\UseCases\Merchant\DeleteMerchantUseCase;
use App\UseCases\Merchant\StoreMerchantUseCase;
use App\UseCases\Merchant\UpdateMerchantUseCase;
use Exception;
use Illuminate\Http\JsonResponse;

class MerchantController extends BaseApiController
{
    /**
     * @param StoreMerchantRequest $request
     * @param StoreMerchantUseCase $useCase
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function store(StoreMerchantRequest $request, StoreMerchantUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute(merchantUser: auth()->user(), DTO: StoreMerchantDTO::frommArray($request->validated()));
        } catch (Exception $e) {
            throw new DataBaseException("Merchant not created");
        }

        return new JsonResponse($this->responseSuccess());
    }

    /**
     * @param int $id
     * @param UpdateMerchantRequest $request
     * @param UpdateMerchantUseCase $useCase
     * @return JsonResponse
     */
    public function update(int $id, UpdateMerchantRequest $request, UpdateMerchantUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id, auth()->user(), UpdateMerchantDTO::frommArray($request->validated()));
        } catch (Exception $e) {
            return new JsonResponse($e->getMessage(), $e->getCode());
        }

        return new JsonResponse($this->responseSuccess());
    }

    /**
     * @param int $id
     * @param DeleteMerchantUseCase $useCase
     * @return JsonResponse
     */
    public function delete(int $id, DeleteMerchantUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id, auth()->user());
        } catch (Exception $e) {
            return new JsonResponse($e->getMessage(), $e->getCode());
        }

        return new JsonResponse($this->responseOnDelete());
    }

}
