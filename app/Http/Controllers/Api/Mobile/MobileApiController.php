<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Mobile;

use App\Models\Category;
use App\UseCases\Mobile\Merchant\MerchantIndexUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseApiController\BaseApiController;

class MobileApiController extends BaseApiController
{
    public function merchantIndex(Request $request, MerchantIndexUseCase $useCase): JsonResponse {
        $merchants = $useCase->perform($request);

        return new JsonResponse($this->responseWithPagination($merchants));
    }

    public function merchantCategories(): JsonResponse {
        return new JsonResponse(Category::all());
    }


}
