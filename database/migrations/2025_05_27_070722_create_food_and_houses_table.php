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
        Schema::create('food_and_houses', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('project_id')->constrained();
            $table->string('name');
            $table->string('id_number')->nullable();
            $table->string('cell')->nullable();
            $table->string('village')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('support')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }
};
