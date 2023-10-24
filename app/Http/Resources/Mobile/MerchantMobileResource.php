<?php

namespace App\Http\Resources\Mobile;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @class AdditionalExpenseResource.
 *
 * @property Merchant $resource
 */
class MerchantMobileResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'village_id' => $this->resource->village_id,
            'district_id' => $this->resource->district_id,
            'latitude' => $this->resource->latitude,
            'longitude' => $this->resource->longitude,
            'book_commisison' => $this->resource->book_commisison,
        ];
    }
}
