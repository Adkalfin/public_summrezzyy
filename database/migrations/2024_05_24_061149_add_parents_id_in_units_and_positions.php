<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->foreignId('units_id_parents')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('units');
        });
        Schema::table('positions', function (Blueprint $table) {
            $table->foreignId('positions_id_parent')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('positions');
        });
    }

    public function down(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropForeign(['units_id_parents']);
        });
        Schema::table('positions', function (Blueprint $table) {
            $table->dropForeign(['positions_id_parents']);
        });
    }
};
