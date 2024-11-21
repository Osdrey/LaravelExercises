<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chronometer_id')->constrained()->onDelete('cascade'); // Relacionamos la vuelta con el cronómetro
            $table->decimal('lap_time', 10, 2); // Tiempo de la vuelta
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laps');
    }
};
