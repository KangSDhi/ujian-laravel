<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankSoal extends Model
{
    use HasFactory;

    protected $table = 'bank_soal';

    protected $fillable = [
        'soal_id',
        'tipe',
        'pertanyaan',
        'gambar_pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'pilihan_e',
        'nilai_a',
        'nilai_b',
        'nilai_c',
        'nilai_d',
        'nilai_e',
    ];
}
