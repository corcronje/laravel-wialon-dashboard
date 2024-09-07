<?php

use App\Models\Tank;
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
            $table->integer('cents_per_millilitre');
            $table->integer('pulses_per_millilitre');
            $table->string('status')->default('active');
            $table->string('auth_token')->nullable();
            $table->foreignIdFor(Tank::class)->constrained();
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
