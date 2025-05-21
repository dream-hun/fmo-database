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
        Schema::create('toolkits', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('project_id')->constrained('projects');
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('id_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('tvet_attended')->nullable();
            $table->string('option')->nullable();
            $table->string('level')->nullable();
            $table->string('training_intake')->nullable();
            $table->date('reception_date')->nullable();
            $table->string('toolkit_received')->nullable();
            $table->string('sector')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toolkits');
    }
};
