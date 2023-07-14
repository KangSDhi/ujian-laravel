<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array(
                'soal_id'   => 2,
                'tipe'      => 'pilihan_ganda',
                'pertanyaan'    => 'Nabi Muhammad adalah?',
                'pilihan_a' => 'Tuhan',
                'pilihan_b' => 'Rasul',
                'pilihan_c' => 'Kepala Desa',
                'pilihan_d' => 'Makna',
                'pilihan_e' => 'Ruang',
                'isian_essay'  => null,
                'nilai_a'   => 0,
                'nilai_b'   => 10,
                'nilai_c'   => 0,
                'nilai_d'   => 0,
                'nilai_e'   => 0,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'soal_id'   => 2,
                'tipe'      => 'pilihan_ganda',
                'pertanyaan'    => 'Sebelum Makan Baiknya?',
                'pilihan_a' => 'Membaca Doa',
                'pilihan_b' => 'Membaca Dokumentasi',
                'pilihan_c' => 'Kayang',
                'pilihan_d' => 'Salto',
                'pilihan_e' => 'Mandi',
                'isian_essay'  => null,
                'nilai_a'   => 10,
                'nilai_b'   => 0,
                'nilai_c'   => 0,
                'nilai_d'   => 0,
                'nilai_e'   => 0,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'soal_id'   => 2,
                'tipe'      => 'pilihan_ganda',
                'pertanyaan'    => 'Sholat Subuh Dilakukan Pada Waktu',
                'pilihan_a' => 'sebelum tidur',
                'pilihan_b' => 'setelah tidur',
                'pilihan_c' => 'dimulai usai berkumandang adzan dari terbit fajar shadiq, yaitu fajar kedua hingga sebelum masuknya waktu matahari terbit (syuruq)',
                'pilihan_d' => 'sebelum bumi ada',
                'pilihan_e' => 'sebelum bulan ada',
                'isian_essay'  => null,
                'nilai_a'   => 0,
                'nilai_b'   => 0,
                'nilai_c'   => 10,
                'nilai_d'   => 0,
                'nilai_e'   => 0,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'soal_id'   => 2,
                'tipe'      => 'pilihan_ganda',
                'pertanyaan'    => 'Sebelum Sholat Subuh Sholat Apa?',
                'pilihan_a' => 'Sholat Isya\'',
                'pilihan_b' => 'Sholat Ashar',
                'pilihan_c' => 'Sholat Dhuha',
                'pilihan_d' => 'Sholat Qunut',
                'pilihan_e' => 'Sholat qobliyah subuh',
                'isian_essay'  => null,
                'nilai_a'   => 0,
                'nilai_b'   => 0,
                'nilai_c'   => 0,
                'nilai_d'   => 0,
                'nilai_e'   => 10,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'soal_id'   => 2,
                'tipe'      => 'pilihan_ganda',
                'pertanyaan'    => 'Makanan atau Minuman Yang Diharamkan Di Islam, Kecuali?',
                'pilihan_a' => 'Babi',
                'pilihan_b' => 'Anjing',
                'pilihan_c' => 'Orang Tua',
                'pilihan_d' => 'Arak',
                'pilihan_e' => 'Ciu',
                'isian_essay'  => null,
                'nilai_a'   => 0,
                'nilai_b'   => 0,
                'nilai_c'   => 10,
                'nilai_d'   => 0,
                'nilai_e'   => 0,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
            array(
                'soal_id'   => 4,
                'tipe'      => 'pilihan_ganda',
                'pertanyaan'    => 'Paragraf berikut yang merupakan paragraf deskripsi adalah...',
                'pilihan_a' => 'Edo mengajak Dodo bermain bola. Dodo pun menyanggupinya. Mereka pun mencari teman-teman yang lain untuk diajak bermain bola. Namun, ternyata teman-teman lainnya tidak mau. Edo dan Dodo pun gagal untuk bermain bola.',
                'pilihan_b' => 'Harimau sudah siap menerkam Kancil. Namun, Kancil menghentikannya. Ia merayu Harimau agar tidak memakannya. Kancil justru menawarkan kepada Harimau untuk melihat Gong Sulaiman. Harimau pun tertarik.',
                'pilihan_c' => 'Metamorfosis adalah tahap perubahan makhluk hidup. Metamorfosis dibagi menjadi dua, yaitu sempurna dan tidak sempurna. Contoh metamorfosis sempurna adalah tahap perubahan pada kupu-kupu, nyamuk, lalat, dan lain-lain. Sementara itu, contoh metamorfosis tak sempurna adalah jangkrik, belalang, lipas, dan lain-lain.',
                'pilihan_d' => 'Panggung dengan ukuran yang sangat luas berdiri di tepi sebuah lapangan. Para penonton sudah tumpah ruah memenuhi lapangan. Namun, suasana panggung masih gelap. Ratusan lampu penerang belum juga dinyalakan. Dari tengah lapangan, para penonton terdengar riuh memanggil sebuah nama penyanyi yang akan tampil dalam konser di lapangan itu.',
                'pilihan_e' => 'Edo mengajak Dodo bermain bola.',
                'isian_essay'  => null,
                'nilai_a'   => 0,
                'nilai_b'   => 0,
                'nilai_c'   => 0,
                'nilai_d'   => 10,
                'nilai_e'   => 0,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ),
        );

        DB::table('bank_soal')->insert($data);
    }
}
