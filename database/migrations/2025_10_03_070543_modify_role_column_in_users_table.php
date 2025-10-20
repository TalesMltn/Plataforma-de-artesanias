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
        Schema::table('users', function (Blueprint $table) {
            // Cambiamos role para que solo acepte admin, artesano o cliente
            $table->enum('role', ['admin', 'artesano', 'cliente'])->default('cliente')->change();
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('cliente')->change();
        });
    }
};
