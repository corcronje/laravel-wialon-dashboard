<?php

use App\Models\Driver;
use App\Models\Unit;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Unit::class, 'unit_id');
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(Driver::class, 'driver_id');
            $table->integer('fuel_allowed_litres');
            $table->integer('fuel_replenished_litres')->nullable();
            $table->integer('mileage_km');
            $table->string('status')->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
