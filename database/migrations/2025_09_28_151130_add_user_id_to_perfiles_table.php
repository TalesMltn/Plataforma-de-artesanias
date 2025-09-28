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
        Schema::table('perfiles', function (Blueprint $table) {
            if (!Schema::hasColumn('perfiles', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }
        });
    }
    
    
    public function down(): void
    {
        Schema::table('perfiles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
    
};
