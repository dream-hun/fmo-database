<?php

declare(strict_types=1);

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
        Schema::create('mvtcs', function (Blueprint $table) {
            $table->id();
            $table->string('reg_no')->nullable();
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('student_id')->nullable();
            $table->string('student_contact')->nullable();
            $table->string('trade')->nullable();
            $table->string('village')->nullable();
            $table->string('cell')->nullable();
            $table->string('sector')->nullable();
            $table->string('resident_district')->nullable();
            $table->string('education_level')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('intake')->nullable();
            $table->string('graduation_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mvtcs');
    }
};
