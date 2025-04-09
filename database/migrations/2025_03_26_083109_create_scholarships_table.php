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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('project_id')->constrained('projects');
            $table->string('surname');
            $table->string('first_name');
            $table->string('gender');
            $table->integer('id_number')->unique();
            $table->string('district')->nullable();
            $table->string('sector')->nullable();
            $table->string('cell')->nullable();
            $table->string('village')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('school_to_attend')->nullable();
            $table->string('study_option')->nullable();
            $table->string('program_duration')->nullable();
            $table->string('budget_up_to_completion')->nullable();
            $table->integer('year_of_entrance')->nullable();
            $table->string('intake')->nullable();
            $table->string('school_contact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
