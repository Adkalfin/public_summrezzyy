<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('employees_education', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->string('line_no');
            $table->foreignId('employees_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('employees');
            $table->timestamps();
            $table->date('date');
            $table->string('degree');
            $table->string('status');
            $table->string('school');
            $table->string('major');
            $table->string('gpa');
            $table->string('file_url')->nullable();
            $table->string('note')->nullable();
            $table->string('is_active')->default('1');
            $table->string('is_delete')->default('0');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('employees_education');
    }
};
