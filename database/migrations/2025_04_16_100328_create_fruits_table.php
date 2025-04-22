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
        Schema::create('fruits', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('project_id')->constrained('projects');
            $table->string('surname');
            $table->string('first_name');
            $table->string('gender')->nullable();
            $table->string('national')->nullable();
            $table->string('sector')->nullable();
            $table->string('cell')->nullable();
            $table->string('village')->nullable();
            $table->integer('mangoes')->nullable();
            $table->integer('avocado')->nullable();
            $table->integer('papaya')->nullable();
            $table->integer('oranges')->nullable();
            $table->string('telephone')->nullable();
            $table->string('distribution_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fruits');
    }
};
