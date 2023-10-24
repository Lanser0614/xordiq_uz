<?php

namespace App\Http\Controllers\Api\Admin\MerchantFeature;

use App\DTOs\MerchantFeature\StoreMerchantFeatureDTO;
use App\Exceptions\DataBaseException;
use App\Exceptions\DtoException\ParseException;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Admin\MerchantFeature\StoreMerchantFeatureRequest;
use App\Http\Requests\Admin\MerchantFeature\UpdateMerchantFeatureRequest;
use App\Models\MerchantFeature;
use App\UseCases\Admin\MerchantFeature\MerchantFeatureDeleteUseCase;
use App\UseCases\Admin\MerchantFeature\MerchantFeatureStoreUseCase;
use App\UseCases\Admin\MerchantFeature\MerchantFeatureUpdateUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MerchantFeatureController extends BaseApiController {
    public function index(Request $request): JsonResponse {
        $merchantFeature = MerchantFeature::query()->paginate($request->perPage ?? 15);

        return new JsonResponse($this->responseWithPagination($merchantFeature));
    }

    /**
     * @throws ParseException
     * @throws DataBaseException
     */
    public function store(StoreMerchantFeatureRequest $request, MerchantFeatureStoreUseCase $useCase): JsonResponse {
        $useCase->execute(StoreMerchantFeatureDTO::frommArray($request->validated()));

        return new JsonResponse($this->responseSuccess());
    }

    /**
     * @throws DataBaseException
     * @throws ParseException
     */
    public function update(int $id, UpdateMerchantFeatureRequest $request, MerchantFeatureUpdateUseCase $useCase): JsonResponse {
        $useCase->execute($id, StoreMerchantFeatureDTO::frommArray($request->validated()));

        return new JsonResponse($this->responseSuccess());
    }

    public function delete(int $id, MerchantFeatureDeleteUseCase $useCase): JsonResponse {
        $useCase->execute($id);

        return new JsonResponse($this->responseOnDelete());
    }
}
