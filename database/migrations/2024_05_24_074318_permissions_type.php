<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('permissions_type', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->string('name');
            $table->year('start_year');
            $table->year('end_year');
            $table->timestamps();
            $table->string('is_active')->default('1');
            $table->string('is_delete')->default('0');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('permissions_type');
    }
};
