<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Soal;
use App\Models\Ujian;
use App\Models\BankSoal;
use App\Models\Nilai;

class ResultUjianController extends Controller
{
    private $user;

    public function __construct()
    {
        if (!auth('jwt')->guest()) {
            $user = auth('jwt')->user();
            $this->user = $user;
        }
    }

    public function index(Request $request)
    {
        $querySoal = Soal::where('id', $request->input('idSoal'))
            ->first();
        $data['nama_ujian'] = $querySoal->nama_soal;
        $data['title'] = 'Hasil Ujian ' . $data['nama_ujian'];
        $data['nama_user'] = $this->user->name;

        return view('siswa.result', $data);
    }

    public function getResultUjian(Request $request){
        // dd($request->input('idSoal'), $this->user);
        $idSoal = $request->input('idSoal');
        $idUser = $this->user->id;
        $ujian = Ujian::where('soal_id', $idSoal)
            ->where('user_id', $idUser)
            ->first();
        // dd($ujian->list_jawaban);
        $listJawaban = json_decode($ujian->list_jawaban);

        $nilai = 0;
        foreach ($listJawaban as $key => $item) {
            // dd($item->id_bank);
            $query = BankSoal::where('id', $item->id_bank)
                ->first();
            if($item->jawaban_pg == $query->pilihan_a){
                $nilai += $query->nilai_a;
            }else if($item->jawaban_pg == $query->pilihan_b){
                $nilai += $query->nilai_b;
            }else if($item->jawaban_pg == $query->pilihan_c){
                $nilai += $query->nilai_c;
            }else if($item->jawaban_pg == $query->pilihan_d){
                $nilai += $query->nilai_d;
            }else if($item->jawaban_pg == $query->pilihan_e){
                $nilai += $query->nilai_e;
            }
        }

        Ujian::where('id', $ujian->id)->update([
            'status_ujian'  => 'Selesai'
        ]);

        Nilai::updateOrCreate(
            [
                'ujian_id'  => $ujian->id,
            ],
            [
                'nilai' => $nilai
            ]
        );
        
        return response()->json([
            'nilai' => $nilai
        ], 200);
    }
}
