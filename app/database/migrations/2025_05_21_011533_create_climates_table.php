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
        Schema::create('climates', function (Blueprint $table) {
            $table->id();
            $table->dateTime('horario');
            $table->float('temp_ar_ecmwf')->nullable();
            $table->float('temp_ar_noaa')->nullable();
            $table->float('temp_ar_sg')->nullable();
            $table->timestamps();

            $table->unique('horario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('climates');
    }
};
