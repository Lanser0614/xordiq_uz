<?php

namespace App\Http\Controllers\Api\Admin\MerchantFeature;

use App\DTOs\MerchantDTOs\MerchantFeature\StoreMerchantFeatureDTO;
use App\Exceptions\DataBaseException;
use App\Exceptions\DtoException\ParseException;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Admin\MerchantFeature\StoreMerchantFeatureRequest;
use App\Http\Requests\Admin\MerchantFeature\UpdateMerchantFeatureRequest;
use App\Http\Resources\MerchantDashboardResource\MerchantFeature\MerchantFeatureResource;
use App\Models\Merchant\MerchantFeature;
use App\Repository\MerchantFeatureRepository\MerchantFeatureRepositoryInterface;
use App\UseCases\Admin\MerchantFeature\MerchantFeatureDeleteUseCase;
use App\UseCases\Admin\MerchantFeature\MerchantFeatureStoreUseCase;
use App\UseCases\Admin\MerchantFeature\MerchantFeatureUpdateUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MerchantFeatureController extends BaseApiController {
    public function __construct(
        private readonly MerchantFeatureRepositoryInterface $merchantFeatureRepository,
    ) {
    }

    public function index(Request $request): JsonResponse {
        $merchantFeature = MerchantFeature::query()->paginate($request->perPage ?? 15);

        return new JsonResponse($this->responseWithPagination(MerchantFeatureResource::collection($merchantFeature)->resource));
    }

    /**
     * @throws ParseException
     * @throws DataBaseException
     */
    public function store(StoreMerchantFeatureRequest $request, MerchantFeatureStoreUseCase $useCase): JsonResponse {
        $useCase->execute(StoreMerchantFeatureDTO::frommArray($request->validated()));

        return new JsonResponse($this->responseSuccess());
    }

    public function show(int $id): JsonResponse {
        $model = $this->merchantFeatureRepository->findById($id);

        return new JsonResponse($this->responseOneItem((new MerchantFeatureResource($model))->resource));
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
