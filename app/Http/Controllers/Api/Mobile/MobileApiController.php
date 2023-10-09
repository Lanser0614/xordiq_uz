<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Mobile;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\UseCases\Mobile\Merchant\MerchantIndexUseCase;
use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Mobile\Merchant\MerchantDistanceRequest;
use App\UseCases\Mobile\Merchant\GetDistanceToMerchantUseCase;

class MobileApiController extends BaseApiController
{
    public function merchantIndex(Request $request, MerchantIndexUseCase $useCase): JsonResponse
    {
        $merchants = $useCase->perform($request);

        return new JsonResponse($this->responseWithPagination($merchants));
    }

    public function merchantCategories(): JsonResponse
    {
        return new JsonResponse(Category::all());
    }

    public function getMerchantDistance(MerchantDistanceRequest $request, GetDistanceToMerchantUseCase $useCase): JsonResponse
    {
        $latitudeFrom = $request->input('latitudeFrom');
        $longitudeFrom = $request->input('longitudeFrom');
        $radius = $request->input('radius');

        return new JsonResponse($useCase->perform($latitudeFrom, $longitudeFrom, $radius));
    }
}
