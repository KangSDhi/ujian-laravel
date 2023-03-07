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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('soal_id');
            $table->unsignedBigInteger('ujian_id');
            $table->unsignedInteger('nilai');
            $table->timestamps();

            $table->foreign('soal_id')
                ->references('id')
                ->on('soal')
                ->onDelete('cascade');
                
            $table->foreign('ujian_id')
                ->references('id')
                ->on('ujian')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
