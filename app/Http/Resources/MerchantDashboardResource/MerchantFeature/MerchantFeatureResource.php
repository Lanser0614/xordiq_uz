<?php

namespace App\Http\Resources\MerchantDashboardResource\MerchantFeature;

use App\Models\Merchant\MerchantFeature;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @class AdditionalExpenseResource.
 *
 * @property MerchantFeature $resource
 */
class MerchantFeatureResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'icon' => $this->resource->image,
        ];
    }
}
