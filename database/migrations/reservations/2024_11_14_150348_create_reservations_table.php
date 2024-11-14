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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->unsignedBigInteger('class_id'); // ID de la clase reservada
            $table->string('user_name'); // Nombre del usuario (no se manejarán usuarios aparte)
            $table->integer('age'); // Edad del usuario
            $table->string('phone'); // Número de teléfono
            $table->string('education_level'); // Nivel educativo
            $table->string('email'); // Correo electrónico
            $table->dateTime('reservation_date'); // Fecha de reserva
            $table->enum('status', ['pending', 'in_process', 'completed', 'cancelled']); // Estado de la reserva
            $table->timestamps(); // created_at y updated_at
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade'); // Relación con la tabla de clases
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
