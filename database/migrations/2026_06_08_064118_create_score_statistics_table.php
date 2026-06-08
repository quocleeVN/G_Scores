<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('score_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 50);
            $table->string('range_key', 10);
            $table->unsignedInteger('student_count');
            $table->timestamps();

            $table->unique(['subject', 'range_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('score_statistics');
    }
};
