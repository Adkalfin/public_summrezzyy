<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('users_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('users');
            $table->foreignId('permissions_type')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('permissions_type');
            $table->string('is_approved');
            $table->string('is_active')->default('1');
            $table->string('is_delete')->default('0');
            $table->string('image_url')->nullable();
            $table->string('reason')->nullable();
    });
    }


    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
