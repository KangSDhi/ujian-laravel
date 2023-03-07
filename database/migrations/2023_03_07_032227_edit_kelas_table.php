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
        Schema::table('kelas', function(Blueprint $table) {
            $table->unsignedBigInteger('jurusan_id')->index();

            $table->foreign('jurusan_id')
                ->references('id')
                ->on('jurusan')
                ->onDelete('cascade');
        });
    }    
};
