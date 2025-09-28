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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'telefono')) {
                $table->string('telefono')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'direccion')) {
                $table->string('direccion')->nullable()->after('telefono');
            }
            if (!Schema::hasColumn('users', 'tipo')) {
                $table->enum('tipo', ['cliente', 'artesano'])->default('cliente')->after('direccion');
            }
            if (!Schema::hasColumn('users', 'seudonimo')) {
                $table->string('seudonimo')->nullable()->unique()->after('tipo');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'telefono')) {
                $table->dropColumn('telefono');
            }
            if (Schema::hasColumn('users', 'direccion')) {
                $table->dropColumn('direccion');
            }
            if (Schema::hasColumn('users', 'tipo')) {
                $table->dropColumn('tipo');
            }
            if (Schema::hasColumn('users', 'seudonimo')) {
                $table->dropColumn('seudonimo');
            }
        });
    }
};
