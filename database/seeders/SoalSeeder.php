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
                'nama_soal' => 'Matematika Diskrit',
                'butir_soal' => 25,
                'acak' => true,
                'waktu_mulai' => '2023-04-20 07:30:00',
                'durasi'    => '01:30:00',
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'nama_soal' => 'Pendidikan Agama dan Budi Pekerti',
                'butir_soal' => 60,
                'acak' => true,
                'waktu_mulai' => '2023-04-20 07:30:00',
                'durasi'    => '01:30:00',
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'nama_soal' => 'Pendidikan Pancasila dan Kewarganegaraan',
                'butir_soal' => 60,
                'acak' => true,
                'waktu_mulai' => '2023-04-20 07:30:00',
                'durasi'    => '01:30:00',
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'nama_soal' => 'Bahasa Indonesia',
                'butir_soal' => 50,
                'acak' => false,
                'waktu_mulai' => '2023-04-20 07:30:00',
                'durasi'    => '01:30:00',
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'nama_soal' => 'Bahasa Inggris',
                'butir_soal' => 50,
                'acak' => true,
                'waktu_mulai' => '2023-04-20 07:30:00',
                'durasi'    => '01:30:00',
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'nama_soal' => 'Seni Budaya',
                'butir_soal' => 50,
                'acak' => false,
                'waktu_mulai' => '2023-04-20 07:30:00',
                'durasi'    => '01:30:00',
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'nama_soal' => 'Pendidikan Jasmani dan Rohani',
                'butir_soal' => 60,
                'acak' => true,
                'waktu_mulai' => '2023-04-20 07:30:00',
                'durasi'    => '01:30:00',
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
        );

        Soal::insert($data);
    }
}
