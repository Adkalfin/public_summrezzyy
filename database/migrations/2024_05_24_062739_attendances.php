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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->date('date');
            $table->time('check_in');
            $table->time('check_out')->nullable()->default(null);
            $table->string('latlong_in');
            $table->string('latlong_out')->nullable()->default(null);
            $table->string('status')->default('default_value');
            $table->foreignId('employees_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('employees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};