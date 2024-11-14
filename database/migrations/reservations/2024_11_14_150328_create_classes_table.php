<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->string('subject'); // Materia
            $table->dateTime('start_time'); // Fecha y hora de inicio
            $table->dateTime('end_time'); // Fecha y hora final
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
};
