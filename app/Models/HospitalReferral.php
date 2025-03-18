<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HospitalReferral extends Model
{
    protected $guarded = [];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, "nik", "patient_nik");
    }

    public function healthFacility(): BelongsTo
    {
        return $this->belongsTo(HealthFacility::class);
    }

    public function poly(): BelongsTo
    {
        return $this->belongsTo(Poly::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, "id", "doctor_id");
    }

    public function targetHealthFacility(): BelongsTo
    {
        return $this->belongsTo(HealthFacility::class, "id", "target_health_facility_id");
    }

    public function targetPoly(): BelongsTo
    {
        return $this->belongsTo(Poly::class, "id", "target_poly_id");
    }
}
