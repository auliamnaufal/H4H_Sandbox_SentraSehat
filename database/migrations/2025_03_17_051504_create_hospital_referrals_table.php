<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hospital_referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId("patient_nik")->constrained("users", "nik");
            $table->foreignId("health_facility_id")->constrained();
            $table->foreignId("poly_id")->constrained();
            $table->foreignId("doctor_id")->constrained("users", "id");
            $table->foreignId("target_health_facility_id")->constrained("health_facilities", "id");
            $table->foreignId("target_poly_id")->constrained("polies", "id");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_referrals');
    }
};
