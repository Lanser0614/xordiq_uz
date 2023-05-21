<?php

namespace App\Http\Controllers\Api\Region;

use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Models\District;
use App\Models\Region;
use App\Models\Village;
use Illuminate\Http\JsonResponse;

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
        $villages = Village::query()->where("district_id", $district_id)->get();
        return new JsonResponse($villages);
    }
}
