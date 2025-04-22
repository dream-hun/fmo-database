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
        Schema::create('malnutritions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->string('surname');
            $table->string('first_name');
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('health_center')->nullable();
            $table->string('sector')->nullable();
            $table->string('cell')->nullable();
            $table->string('village')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('home_phone')->nullable();
            $table->date('package_reception_date')->nullable();
            $table->integer('entry_muac')->nullable();
            $table->integer('currently_muac')->nullable();
            $table->string('current_malnutrition_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('malnutritions');
    }
};
