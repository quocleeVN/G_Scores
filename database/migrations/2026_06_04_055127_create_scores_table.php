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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('sbd', 20)->unique();
            $table->decimal('toan', 5, 2)->nullable();
            $table->decimal('ngu_van', 5, 2)->nullable();
            $table->decimal('ngoai_ngu', 5, 2)->nullable();
            $table->decimal('vat_li', 5, 2)->nullable();
            $table->decimal('hoa_hoc', 5, 2)->nullable();
            $table->decimal('sinh_hoc', 5, 2)->nullable();
            $table->decimal('lich_su', 5, 2)->nullable();
            $table->decimal('dia_li', 5, 2)->nullable();
            $table->decimal('gdcd', 5, 2)->nullable();
            $table->string('ma_ngoai_ngu', 10)->nullable();
            $table->decimal('khoi_a_total', 6, 2)
                ->virtualAs('toan + vat_li + hoa_hoc')
                ->nullable();
            $table->timestamps();

            // Indexes for performance
            $table->index('toan');
            $table->index('ngu_van');
            $table->index('ngoai_ngu');
            $table->index('vat_li');
            $table->index('hoa_hoc');
            $table->index('sinh_hoc');
            $table->index('lich_su');
            $table->index('dia_li');
            $table->index('gdcd');
            $table->index('khoi_a_total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
