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
        Schema::table('soal', function(Blueprint $table){
            $table->enum('tingkat_ref', ['X', 'XI', 'XII', 'XIII'])->nullable();

            $table->unsignedBigInteger('jurusan_id')->nullable();

            $table->string('tipe_soal')->nullable();

            $table->foreign('jurusan_id')
                ->references('id')
                ->on('jurusan');

        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
