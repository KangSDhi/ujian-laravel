<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Soal;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array(
                'nama_soal'     => 'Matematika Diskrit',
                'butir_soal'    => 25,
                'acak'          => true
            )
        );

        Soal::insert($data);
    }
}
