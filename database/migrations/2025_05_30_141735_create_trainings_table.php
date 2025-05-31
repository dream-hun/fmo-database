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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('national_id')->nullable();
            $table->string('district')->nullable();
            $table->string('sector')->nullable();
            $table->string('telephone')->nullable();
            $table->string('training_given')->nullable();
            $table->string('position')->nullable();
            $table->string('institution')->nullable();
            $table->date('training_date')->nullable();
            $table->timestamps();
        });
    }


};
