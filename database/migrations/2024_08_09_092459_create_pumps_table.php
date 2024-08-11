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
        Schema::create('pumps', function (Blueprint $table) {
            $table->id();
            $table->string('guid')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('cents_per_litre');
            $table->integer('volume_litres');
            $table->integer('current_litres')->default(0);
            $table->integer('pulses_per_litre');
            $table->string('status')->default('active');
            $table->string('auth_token')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pumps');
    }
};
