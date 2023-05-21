<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseApiController
{
    /**
     * @return JsonResponse
     */
    public function getCategories(): JsonResponse
    {
        return new JsonResponse(Category::all());
    }
}
