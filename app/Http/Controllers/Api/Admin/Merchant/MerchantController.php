<?php

namespace App\Http\Controllers\Api\Admin\Merchant;

use App\DTOs\MerchantDTOs\Merchant\StoreMerchantDTO;
use App\DTOs\MerchantDTOs\Merchant\UpdateMerchantDTO;
use App\Enums\Ability\AbilityEnum;
use App\Exceptions\DataBaseException;
use App\Exceptions\DtoException\ParseException;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Admin\Merchant\StoreMerchantRequest;
use App\Http\Requests\Admin\Merchant\UpdateMerchantRequest;
use App\UseCases\Admin\Merchant\DeleteMerchantUseCase;
use App\UseCases\Admin\Merchant\SetCategoryForMerchantUseCase;
use App\UseCases\Admin\Merchant\ShowMerchantUseCase;
use App\UseCases\Admin\Merchant\StoreMerchantUseCase;
use App\UseCases\Admin\Merchant\UpdateMerchantUseCase;
use App\UseCases\Admin\Merchant\UserMerchantsIndexUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MerchantController extends BaseApiController {
    /**
     * @throws DataBaseException
     * @throws ParseException
     */
    public function store(StoreMerchantRequest $request, StoreMerchantUseCase $useCase): JsonResponse {
        $useCase->execute(merchantUser: auth()->user(), DTO: StoreMerchantDTO::frommArray($request->validated()));

        return new JsonResponse($this->responseSuccess());
    }

    public function index(
        Request $request,
        UserMerchantsIndexUseCase $useCase
    ) {
        $merchants = $useCase->execute(auth()->user(), $request->input('prePage') ?? 15, $request->input('page') ?? 1);

        return new JsonResponse($this->responseWithPagination($merchants->resource));
    }

    public function show(int $id, ShowMerchantUseCase $useCase): JsonResponse {
        $merchant = $useCase->execute($id, auth()->user());

        return new JsonResponse($this->responseOneItem($merchant->resource));
    }

    /**
     * @throws DataBaseException
     * @throws ParseException
     */
    public function update(int $id, UpdateMerchantRequest $request, UpdateMerchantUseCase $useCase): JsonResponse {
        $this->authorize(AbilityEnum::CAN_UPDATE_MERCHANT, $id);

        $useCase->execute($id, auth()->user(), UpdateMerchantDTO::frommArray($request->validated()));

        return new JsonResponse($this->responseSuccess());
    }

    public function delete(int $id, DeleteMerchantUseCase $useCase): JsonResponse {
        $this->authorize(AbilityEnum::CAN_DELETE_MERCHANT, $id);

        try {
            $useCase->execute($id, auth()->user());
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

        return new JsonResponse($this->responseOnDelete());
    }

    public function setCategory(int $id, int $category_id, SetCategoryForMerchantUseCase $useCase): JsonResponse {
        $this->authorize(AbilityEnum::CAN_UPDATE_MERCHANT, $id);
        try {
            $useCase->execute($id, $category_id);
        } catch (Exception $e) {
            return new JsonResponse($this->responseOnError($e->getMessage(), $e->getCode()));
        }

        return new JsonResponse($this->responseSuccess());
    }
}
