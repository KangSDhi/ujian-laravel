<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Soal;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    public function getDataSoal(){
        $getUser = auth('jwt')->user();
        $getKelas = Kelas::where('id', $getUser->kelas_id)->first();
        $getToday = date('Y-m-d');
        /**
         * @description Query Mysql $getSoal
         * @description select * from (select nama_soal, tingkat_ref, jurusan_id, tipe_soal 
         * from soal where tingkat_ref = 'XII') as base where jurusan_id is null or jurusan_id = 6
         */
        $getSoal = DB::table(function ($query) use ($getKelas, $getToday) {
            $query->select(DB::raw('nama_soal, tingkat_ref, jurusan_id, tipe_soal, DATE_FORMAT(waktu_mulai, "%d-%b-%Y (%H:%i)") as waktu_mulai, durasi'))
                ->from('soal')
                ->where('tingkat_ref', '=', $getKelas->tingkat)
                ->where('waktu_mulai', 'LIKE', $getToday.'%');
        })->where(function ($query) use ($getKelas) {
            $query->whereNull('jurusan_id')
                ->orWhere('jurusan_id', '=', $getKelas->jurusan_id);
        })
        ->orderBy('waktu_mulai', 'asc')
        ->get();
        return response()->json([
            'success'   => true,
            'message'   => 'Data Daftar Soal',
            'data'      => $getSoal
        ]);
    }
}