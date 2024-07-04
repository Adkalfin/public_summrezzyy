<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('permissions_quota', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->foreignId('permissions_type_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('permissions_type');
            $table->foreignId('employees_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('employees');
            $table->integer('quota');
            $table->timestamps();
            $table->string('is_active')->default('1');
            $table->string('is_delete')->default('0');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions_quota');
    }
};
