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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wialon_id');
            $table->string('wialon_nm');
            $table->string('wialon_mileage_sensor_id');
            $table->float('wialon_mileage_sensor_calibration_factor');
            $table->string('wialon_fuel_consumption_sensor_id');
            $table->float('wialon_fuel_consumption_sensor_calibration_factor');
            $table->integer('fuel_consumed_litres');
            $table->integer('fuel_replenished_litres')->nullable();
            $table->integer('mileage_km');
            $table->integer('mileage_replenished_km')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
