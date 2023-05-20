<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    protected $table = 'rooms';

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, "merchant_id", "id");
    }

}
