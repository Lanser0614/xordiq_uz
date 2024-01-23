<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Http\Requests\Mobile\Merchant\MerchantDistanceRequest;
use App\Models\Common\Category;
use App\Models\Merchant\Merchant;
use App\UseCases\Mobile\Merchant\GetDistanceToMerchantUseCase;
use App\UseCases\Mobile\Merchant\MerchantIndexUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MobileApiController extends BaseApiController {
    public function merchantIndex(Request $request, MerchantIndexUseCase $useCase): JsonResponse {
        $merchants = $useCase->perform($request);

        return new JsonResponse($this->responseWithPagination($merchants->resource));
    }

    public function merchantCategories(): JsonResponse {
        return new JsonResponse(
            $this->responseWithResult(Category::all()->map(function (Category $category) {
                return [
                    'id' => $category->id,
                    'title' => $category->title,
                ];
            })->toArray()
            )
        );
    }

    public function showMerchant(int $id): JsonResponse {
        $merchant = Merchant::query()->whereId($id)->firstOrFail();

        return new JsonResponse($this->responseOneItem($merchant));
    }

    public function getMerchantDistance(MerchantDistanceRequest $request, GetDistanceToMerchantUseCase $useCase): JsonResponse {
        $latitudeFrom = $request->input('latitudeFrom');
        $longitudeFrom = $request->input('longitudeFrom');
        $radius = $request->input('radius');

        return new JsonResponse($useCase->perform($latitudeFrom, $longitudeFrom, $radius));
    }
}
