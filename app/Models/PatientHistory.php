<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientHistory extends Model
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
        return $this->belongsTo(User::class, "doctor_id", "id");
    }
}
