<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('ingredients');
            $table->integer('prep_time'); // Tiempo de preparación en minutos
            $table->integer('cook_time'); // Tiempo de cocción en minutos
            $table->string('difficulty'); // Dificultad (facil, media, dificil)
            $table->enum('meal_type', ['breakfast', 'lunch', 'dinner', 'snack', 'dessert']); // Tipo de comida
            $table->enum('diet_type', ['vegan', 'gluten_free', 'low_carb', 'none']); // Tipo de dieta
            $table->string('category'); // Categoría de la receta (e.g. mexicana, italiana, etc.)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipes');
    }
};
