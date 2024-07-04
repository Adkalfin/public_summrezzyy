<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('employees_skill', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->string('line_no');
            $table->timestamps();
            $table->foreignId('employees_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('employees');
            $table->string('training');
            $table->string('note');
            $table->string('file_url')->nullable();
            $table->date('effective_date')->nullable();
            $table->date('expired_date')->nullable();
            $table->string('is_active')->default('1');
            $table->string('is_delete')->default('0');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('employees_skill');
    }
};
