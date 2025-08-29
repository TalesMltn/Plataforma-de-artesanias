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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del producto
            $table->text('descripcion')->nullable(); // Descripción opcional
            $table->decimal('precio', 10, 2); // Precio con 2 decimales
            $table->integer('stock')->default(0); // Cantidad en inventario
            $table->string('categoria')->nullable(); // Tipo/categoría del producto
            $table->string('imagen')->nullable(); // Ruta de imagen
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
