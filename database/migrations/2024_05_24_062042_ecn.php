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
        Schema::create('ecn', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->timestamps();
            $table->foreignId('employees_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('employees');
            $table->foreignId('companies_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('companies');
            $table->foreignId('positions_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('positions');
            $table->string('is_active')->default('1');
            $table->string('is_delete')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecn');
    }
};
