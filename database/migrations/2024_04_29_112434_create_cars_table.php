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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('make')->nullable(false);
            $table->string('model')->nullable(false);
            $table->boolean('available')->default(1)->nullable(false);
            $table->float('day_rate', 2)->nullable(false);
            $table->float('young_driver_premium', 2)->nullable();
            $table->float('senior_driver_premium', 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
