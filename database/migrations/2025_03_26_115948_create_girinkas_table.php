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
        Schema::create('girinkas', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('names');
            $table->string('gender')->nullable();
            $table->string('id_number')->nullable();
            $table->string('sector')->nullable();
            $table->string('village')->nullable();
            $table->string('cell')->nullable();
            $table->date('distribution_date')->nullable();
            $table->string('m_status')->nullable();
            $table->string('pass_over')->nullable();
            $table->string('telephone')->nullable();
            $table->longText('comment')->nullable();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('girinkas');
    }
};
