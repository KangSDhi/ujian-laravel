<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            // TKP
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TKP 1',
                'jurusan_id'    => 1,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TKP 2',
                'jurusan_id'    => 1,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI TKP 1',
                'jurusan_id'    => 1,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI TKP 2',
                'jurusan_id'    => 1,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII TKP 1',
                'jurusan_id'    => 1,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII TKP 2',
                'jurusan_id'    => 1,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            // DPIB
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X DPIB 1',
                'jurusan_id'    => 2,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X DPIB 2',
                'jurusan_id'    => 2,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI DPIB 1',
                'jurusan_id'    => 2,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI DPIB 2',
                'jurusan_id'    => 2,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII DPIB 1',
                'jurusan_id'    => 2,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII DPIB 2',
                'jurusan_id'    => 2,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            // KI
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X KI 1',
                'jurusan_id'    => 3,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI KI 1',
                'jurusan_id'    => 3,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII KI 1',
                'jurusan_id'    => 3,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            // GMT
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X GMT 1',
                'jurusan_id'    => 4,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X GMT 2',
                'jurusan_id'    => 4,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI GMT 1',
                'jurusan_id'    => 4,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI GMT 2',
                'jurusan_id'    => 4,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII GMT 1',
                'jurusan_id'    => 4,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII GMT 2',
                'jurusan_id'    => 4,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            // TITL
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TITL 1',
                'jurusan_id'    => 5,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TITL 2',
                'jurusan_id'    => 5,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI TITL 1',
                'jurusan_id'    => 5,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI TITL 2',
                'jurusan_id'    => 5,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII TITL 1',
                'jurusan_id'    => 5,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII TITL 2',
                'jurusan_id'    => 5,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            // TKJ
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TKJ 1',
                'jurusan_id'    => 6,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TKJ 2',
                'jurusan_id'    => 6,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI TKJ 1',
                'jurusan_id'    => 6,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI TKJ 2',
                'jurusan_id'    => 6,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII TKJ 1',
                'jurusan_id'    => 6,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII TKJ 2',
                'jurusan_id'    => 6,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            // MEKA
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X MEKA 1',
                'jurusan_id'    => 7,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI MEKA 1',
                'jurusan_id'    => 7,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII MEKA 1',
                'jurusan_id'    => 7,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XIII',
                'kelas'         => 'XIII MEKA 1',
                'jurusan_id'    => 7,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            // TKR
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TKR 1',
                'jurusan_id'    => 8,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TKR 2',
                'jurusan_id'    => 8,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TKR 3',
                'jurusan_id'    => 8,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI TKR 1',
                'jurusan_id'    => 8,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI TKR 2',
                'jurusan_id'    => 8,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI TKR 3',
                'jurusan_id'    => 8,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII TKR 1',
                'jurusan_id'    => 8,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII TKR 2',
                'jurusan_id'    => 8,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII TKR 3',
                'jurusan_id'    => 8,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            // TP
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TP 1',
                'jurusan_id'    => 9,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TP 2',
                'jurusan_id'    => 9,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TP 3',
                'jurusan_id'    => 9,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            // TEI
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TEI 1',
                'jurusan_id'    => 10,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'X',
                'kelas'         => 'X TEI 2',
                'jurusan_id'    => 10,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI TEI 1',
                'jurusan_id'    => 10,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XI',
                'kelas'         => 'XI TEI 2',
                'jurusan_id'    => 10,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII TEI 1',
                'jurusan_id'    => 10,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'tingkat'       => 'XII',
                'kelas'         => 'XII TEI 2',
                'jurusan_id'    => 10,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
        );

        DB::table('kelas')->insert($data);
    }
}
