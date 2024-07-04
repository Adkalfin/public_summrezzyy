<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('positions', function (Blueprint $table){
            $table->id()->primary()->autoIncrement();
            $table->string('name');
            $table->timestamps();
            $table->string('is-active')->default('1');
            $table->string('is_delete')->default('0');
            $table->foreignId('jabatans_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('jabatans');
            $table->foreignId('units_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('units');
        });
    }

    public function down(): void
    {
    Schema::dropIfExists('positions');
    }
};
