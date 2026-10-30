<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');                    // PK
            $table->string('student_name');
            $table->string('email')->unique();
            $table->enum('gender', ['Male', 'Female']);
            $table->date('enrollment_date');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('department_id'); // FK -> departments.dept_id
            $table->timestamps();

            $table->foreign('department_id')
                  ->references('dept_id')->on('departments')
                  ->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
