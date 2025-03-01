<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->string('name');
            $table->string('nip')->nullable();
            $table->string('address')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->string('is_active')->default('1');
            $table->string('is_delete')->default('0');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};