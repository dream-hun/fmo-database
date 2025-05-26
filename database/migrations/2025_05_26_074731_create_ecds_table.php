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
        Schema::create('ecds', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('project_id')->constrained();
            $table->string('name');
            $table->string('grade')->nullable();
            $table->string('gender')->nullable();
            $table->integer('academic_year')->nullable();
            $table->string('sector')->nullable();
            $table->string('cell')->nullable();
            $table->string('village')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('home_phone')->nullable();
            $table->timestamps();
        });
    }
};
