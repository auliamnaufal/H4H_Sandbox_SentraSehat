<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Poly extends Model
{
    protected $guarded = [];

    public function healthFacility(): BelongsTo
    {
        return $this->belongsTo(HealthFacility::class);
    }
}
