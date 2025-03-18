<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HealthFacility extends Model
{
    protected $guarded = [];

    public function polies(): HasMany
    {
        return $this->hasMany(Poly::class);
    }

    public function queues(): HasMany
    {
        return $this->hasMany(Queue::class);
    }

    public function hospitalReferrals(): HasMany
    {
        return $this->hasMany(HospitalReferral::class);
    }
}
