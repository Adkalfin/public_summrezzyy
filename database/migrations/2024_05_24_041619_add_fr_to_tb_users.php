<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('employees_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('employees');
            $table->foreignId('geofencings_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('geofencings');
            $table->foreignId('schedules_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('schedules');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['employees_id']);
            $table->dropForeign(['geofencings_id']);
            $table->dropForeign(['schedules_id']);
        });
    }
};
