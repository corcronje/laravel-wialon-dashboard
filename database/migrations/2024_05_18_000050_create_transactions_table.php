<?php

use App\Models\Driver;
use App\Models\Pump;
use App\Models\TransactionType;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(TransactionType::class)->constrained();
            $table->foreignIdFor(Driver::class)->nullable()->constrained();
            $table->foreignIdFor(Pump::class)->nullable()->constrained();
            $table->foreignIdFor(Unit::class)->nullable()->constrained();
            $table->string('description');
            $table->integer('volume_in_millilitres');
            $table->integer('amount_in_cents');
            $table->json('meta')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
