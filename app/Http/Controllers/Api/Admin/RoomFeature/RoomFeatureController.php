<?php

namespace App\Http\Controllers\Api\Admin\RoomFeature;

use App\DTOs\MerchantDTOs\MerchantFeature\StoreMerchantFeatureDTO;
use App\Enums\Ability\AbilityEnum;
use App\Exceptions\DataBaseException;
use App\Exceptions\DtoException\ParseException;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Admin\MerchantFeature\StoreMerchantFeatureRequest;
use App\Http\Requests\Admin\MerchantFeature\UpdateMerchantFeatureRequest;
use App\Http\Resources\MerchantDashboardResource\Room\RoomFeatureResource;
use App\Models\Merchant\RoomFeature;
use App\UseCases\Admin\RoomFeature\RoomFeatureDeleteUseCase;
use App\UseCases\Admin\RoomFeature\RoomFeatureStoreUseCase;
use App\UseCases\Admin\RoomFeature\RoomFeatureUpdateUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomFeatureController extends BaseApiController {
    public function index(Request $request): JsonResponse {
        $this->authorize(AbilityEnum::CAN_SEE_FEATURE->value);
        $merchantFeature = RoomFeature::query()->paginate($request->perPage ?? 15);

        return new JsonResponse($this->responseWithPagination(RoomFeatureResource::collection($merchantFeature)->resource));
    }

    /**
     * @throws DataBaseException
     * @throws ParseException
     */
    public function store(StoreMerchantFeatureRequest $request, RoomFeatureStoreUseCase $useCase): JsonResponse {
        $useCase->execute(StoreMerchantFeatureDTO::frommArray($request->validated()));

        return new JsonResponse($this->responseSuccess());
    }

    /**
     * @throws DataBaseException
     * @throws ParseException
     */
    public function update(int $id, UpdateMerchantFeatureRequest $request, RoomFeatureUpdateUseCase $useCase): JsonResponse {
        $useCase->execute($id, StoreMerchantFeatureDTO::frommArray($request->validated()));

        return new JsonResponse($this->responseSuccess());
    }

    public function delete(int $id, RoomFeatureDeleteUseCase $useCase): JsonResponse {
        $useCase->execute($id);

        return new JsonResponse($this->responseOnDelete());
    }
}
