<?php

namespace App\Http\Controllers\Api\MerchantFeature;

use App\DTOs\MerchantFeature\StoreMerchantFeatureDTO;
use App\Exceptions\DataBaseException;
use App\Exceptions\DtoException\ParseException;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\MerchantFeature\StoreMerchantFeatureRequest;
use App\Http\Requests\MerchantFeature\UpdateMerchantFeatureRequest;
use App\Models\MerchantFeature;
use App\UseCases\MerchantFeature\MerchantFeatureDeleteUseCase;
use App\UseCases\MerchantFeature\MerchantFeatureStoreUseCase;
use App\UseCases\MerchantFeature\MerchantFeatureUpdateUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MerchantFeatureController extends BaseApiController
{
    public function index(Request $request): JsonResponse
    {
        $merchantFeature = MerchantFeature::query()->paginate($request->perPage ?? 15);
        return new JsonResponse($this->responseWithPagination($merchantFeature));
    }
    /**
     * @param StoreMerchantFeatureRequest $request
     * @param MerchantFeatureStoreUseCase $useCase
     * @return JsonResponse
     * @throws ParseException
     * @throws DataBaseException
     */
    public function store(StoreMerchantFeatureRequest $request, MerchantFeatureStoreUseCase $useCase): JsonResponse
    {
        $useCase->execute(StoreMerchantFeatureDTO::frommArray($request->validated()));
        return new JsonResponse($this->responseSuccess());
    }

    /**
     * @param int $id
     * @param UpdateMerchantFeatureRequest $request
     * @param MerchantFeatureUpdateUseCase $useCase
     * @return JsonResponse
     * @throws DataBaseException
     * @throws ParseException
     */
    public function update(int $id, UpdateMerchantFeatureRequest $request, MerchantFeatureUpdateUseCase $useCase): JsonResponse
    {
        $useCase->execute($id, StoreMerchantFeatureDTO::frommArray($request->validated()));
        return new JsonResponse($this->responseSuccess());
    }

    /**
     * @param int $id
     * @param MerchantFeatureDeleteUseCase $useCase
     * @return JsonResponse
     */
    public function delete(int $id, MerchantFeatureDeleteUseCase $useCase): JsonResponse
    {
        $useCase->execute($id);
        return new JsonResponse($this->responseOnDelete());
    }
}
