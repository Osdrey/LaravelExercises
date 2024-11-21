<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chronometers', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_time', 10, 2)->default(0); // Total de tiempo transcurrido
            $table->enum('status', ['paused', 'running', 'stopped'])->default('paused'); // Estado del cronómetro
            $table->timestamp('started_at')->nullable(); // Tiempo de inicio
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chronometers');
    }
};
