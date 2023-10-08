<?php

namespace App\Http\Controllers\Api\Admin\Region;

use App\Models\Region;
use App\Models\Village;
use App\Models\District;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\BaseApiController\BaseApiController;

class RegionController extends BaseApiController
{
    public function getRegions(): JsonResponse
    {
        $regions = Region::all();

        return new JsonResponse($regions);
    }

    public function getDistricts(int $regions_id): JsonResponse
    {
        $districts = District::query()->where('region_id', $regions_id)->get();

        return new JsonResponse($districts);
    }

    public function getVillage(int $district_id): JsonResponse
    {
        $villages = Village::query()->where('district_id', $district_id)->get();

        return new JsonResponse($villages);
    }
}
