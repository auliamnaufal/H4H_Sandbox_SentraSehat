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
        Schema::create('patient_histories', function (Blueprint $table) {
            $table->id();
            $table->text("complaint");
            $table->text("diagnosis");
            $table->text("treatment");
            $table->text("medicine");
            $table->foreignId("patient_nik")->constrained("users", "nik");
            $table->foreignId("health_facility_id")->constrained();
            $table->foreignId("poly_id")->constrained();
            $table->foreignId("doctor_id")->constrained("users", "id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_histories');
    }
};
