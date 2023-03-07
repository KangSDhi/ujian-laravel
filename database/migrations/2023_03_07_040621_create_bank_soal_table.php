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
        Schema::create('bank_soal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('soal_id');
            $table->enum('tipe', ['pilihan_ganda', 'essay']);
            $table->longtext('pertanyaan');
            $table->string('pilihan_a');
            $table->string('pilihan_b');
            $table->string('pilihan_c');
            $table->string('pilihan_d');
            $table->string('pilihan_e');
            $table->string('isian_essay');
            $table->unsignedInteger('nilai_a');
            $table->unsignedInteger('nilai_b');
            $table->unsignedInteger('nilai_c');
            $table->unsignedInteger('nilai_d');
            $table->unsignedInteger('nilai_e');
            $table->timestamps();

            $table->foreign('soal_id')
                ->references('id')
                ->on('soal')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_soal');
    }
};
