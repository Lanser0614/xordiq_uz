<?php

namespace App\Http\Controllers\Api\Merchant;

use App\DTOs\Merchant\StoreMerchantDTO;
use App\DTOs\Merchant\UpdateMerchantDTO;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Merchant\StoreMerchantRequest;
use App\Http\Requests\Merchant\UpdateMerchantRequest;
use App\UseCases\Merchant\DeleteMerchantUseCase;
use App\UseCases\Merchant\ShowMerchantUseCase;
use App\UseCases\Merchant\StoreMerchantUseCase;
use App\UseCases\Merchant\UpdateMerchantUseCase;
use App\UseCases\Merchant\UserMerchantsIndexUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MerchantController extends BaseApiController
{
    public function store(StoreMerchantRequest $request, StoreMerchantUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute(merchantUser: auth()->user(), DTO: StoreMerchantDTO::frommArray($request->validated()));
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

        return new JsonResponse($this->responseSuccess());
    }

    public function index(
        Request $request,
        UserMerchantsIndexUseCase $useCase
    ): mixed {
        return $useCase->execute(auth()->user(), $request->input('prePage') ?? 15, $request->input('page') ?? 1);
    }

    public function show(int $id, ShowMerchantUseCase $useCase): JsonResponse
    {
        $merchant = $useCase->execute($id, auth()->user());

        return new JsonResponse($merchant);
    }

    public function update(int $id, UpdateMerchantRequest $request, UpdateMerchantUseCase $useCase): JsonResponse
    {
        try {
            $useCase->execute($id, auth()->user(), UpdateMerchantDTO::frommArray($request->validated()));
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

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
}
