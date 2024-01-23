<?php

namespace App\Http\Resources\MerchantDashboardResource\Merchant;

use App\Http\Resources\MerchantDashboardResource\Room\RoomDashboardResource;
use App\Models\Merchant\Merchant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @class AdditionalExpenseResource.
 *
 * @property Merchant $resource
 */
class MerchantDashboardResource extends JsonResource {
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
            'village' => $this->resource->village,
            'district' => $this->resource->district,
            'latitude' => $this->resource->latitude,
            'longitude' => $this->resource->longitude,
            'book_commission' => $this->resource->book_commission,
            'images' => $this->resource->images,
            'categories' => $this->resource->merchantsCategories,
            'rooms' => RoomDashboardResource::collection($this->resource->rooms),
        ];
    }
}
