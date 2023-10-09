<?php

declare(strict_types=1);

namespace App\UseCases\Mobile\Merchant;

use App\Enums\Cache\CacheKeyEnum;
use Illuminate\Support\Facades\Cache;
use App\Traits\CalculateDistanceTrait;

class GetDistanceToMerchantUseCase
{
    use CalculateDistanceTrait;

    public function perform($latitudeFrom, $longitudeFrom, ?int $radius = 0): array
    {
        $merchantCoordinate = Cache::get(CacheKeyEnum::MERCHANT_POINTS->name);

        $distance = [];
        foreach ($merchantCoordinate as $value) {
            $latitudeTo = $value['latitude'];
            $longitudeTo = $value['longitude'];
            $merchantId = $value['id'];
            $distance[] = [
                'merchant_id' => $merchantId,
                'latitude' => $latitudeTo,
                'longitude' => $longitudeTo,
                'distance' => $this->calculateDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo),
            ];
        }

        $radius = ($radius == 0) ? collect($distance)->min('distance') : $radius;

        $data = array_values(collect($distance)->where('distance', '<=', $radius)->sortBy('distance')->toArray());

        $result = [
            'result' => $data,
            'radius' => $radius,
        ];

        return $result;
    }
}
