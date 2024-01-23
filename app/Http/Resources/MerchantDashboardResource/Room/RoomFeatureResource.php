<?php

namespace App\Http\Resources\MerchantDashboardResource\Room;

use App\Models\Merchant\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @class AdditionalExpenseResource.
 *
 * @property Room $resource
 */
class RoomFeatureResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
        ];
    }
}
