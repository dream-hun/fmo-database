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
        Schema::create('individuals', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('project_id')->constrained();
            $table->string('name');
            $table->string('id_number')->nullable();
            $table->string('business_name')->nullable();
            $table->string('telephone')->nullable();
            $table->string('guardian')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('sector')->nullable();
            $table->string('cell')->nullable();
            $table->string('village')->nullable();
            $table->integer('loan_amount')->nullable();
            $table->date('loan_date')->nullable();
            $table->string('gender')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('individuals');
    }
};
