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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del gasto
            $table->decimal('amount', 10, 2); // Monto del gasto
            $table->text('description')->nullable(); // Descripción del gasto
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relación con categorías
            $table->date('expense_date'); // Fecha del gasto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
