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
        Schema::create('goats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('id_number')->nullable();
            $table->string('sector')->nullable();
            $table->string('cell')->nullable();
            $table->string('village')->nullable();
            $table->date('distribution_date')->nullable();
            $table->integer('number_of_goats')->nullable();
            $table->string('gender')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goats');
    }
};
