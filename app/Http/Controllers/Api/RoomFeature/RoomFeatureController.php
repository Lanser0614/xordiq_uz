<?php

namespace App\Http\Controllers\Api\RoomFeature;

use App\DTOs\MerchantFeature\StoreMerchantFeatureDTO;
use App\Exceptions\DataBaseException;
use App\Exceptions\DtoException\ParseException;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\MerchantFeature\StoreMerchantFeatureRequest;
use App\Http\Requests\MerchantFeature\UpdateMerchantFeatureRequest;
use App\Models\RoomFeature;
use App\UseCases\RoomFeature\RoomFeatureDeleteUseCase;
use App\UseCases\RoomFeature\RoomFeatureStoreUseCase;
use App\UseCases\RoomFeature\RoomFeatureUpdateUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomFeatureController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $merchantFeature = RoomFeature::query()->paginate($request->perPage ?? 15);

        return new JsonResponse($this->responseWithPagination($merchantFeature));
    }

    /**
     * @param  StoreMerchantFeatureRequest  $request
     * @param  RoomFeatureStoreUseCase  $useCase
     * @return JsonResponse
     *
     * @throws DataBaseException
     * @throws ParseException
     */
    public function store(StoreMerchantFeatureRequest $request, RoomFeatureStoreUseCase $useCase): JsonResponse
    {
        $useCase->execute(StoreMerchantFeatureDTO::frommArray($request->validated()));

        return new JsonResponse($this->responseSuccess());
    }

    /**
     * @throws DataBaseException
     * @throws ParseException
     */
    public function update(int $id, UpdateMerchantFeatureRequest $request, RoomFeatureUpdateUseCase $useCase): JsonResponse
    {
        $useCase->execute($id, StoreMerchantFeatureDTO::frommArray($request->validated()));

        return new JsonResponse($this->responseSuccess());
    }

    /**
     * @param  int  $id
     * @param  RoomFeatureDeleteUseCase  $useCase
     * @return JsonResponse
     */
    public function delete(int $id, RoomFeatureDeleteUseCase $useCase): JsonResponse
    {
        $useCase->execute($id);

        return new JsonResponse($this->responseOnDelete());
    }
}
