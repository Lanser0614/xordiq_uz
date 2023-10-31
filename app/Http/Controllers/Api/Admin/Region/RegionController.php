<?php

namespace App\Http\Controllers\Api\Admin\Region;

use App\Http\Controllers\BaseApiController\BaseApiController;
use App\Models\Common\District;
use App\Models\Common\Region;
use App\Models\Common\Village;
use Illuminate\Http\JsonResponse;

class RegionController extends BaseApiController {
    public function getRegions(): JsonResponse {
        $regions = Region::all();

        return new JsonResponse($regions);
    }

    public function getDistricts(int $regions_id): JsonResponse {
        $districts = District::query()->where('region_id', $regions_id)->get();

        return new JsonResponse($districts);
    }

    public function getVillage(int $district_id): JsonResponse {
        $villages = Village::query()->where('district_id', $district_id)->get();

        return new JsonResponse($villages);
    }
}
