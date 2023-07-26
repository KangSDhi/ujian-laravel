<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\BankSoal;
use App\Models\Ujian;
use DateTime;

class UjianController extends Controller
{
    private $user;

    public function __construct(){
        if (!auth('jwt')->guest()) {
            $user = auth('jwt')->user();
            $this->user = $user;
        }
    }

    public function index(Request $request){
        $query = Soal::where('id', $request->input('idSoal'))->first();
        if ($request->input('idSoal') == null || $query == null) {
            $data['title'] = 'Soal Tidak Dapat Diakses';
            return view('error.accessDenied', $data);
        }
        // dd($request->input('idSoal'), 'noSoal : '.$request->input('noSoal'));
        $data['title'] = "Ujian ".$query->nama_soal;
        return view('siswa.ujian', $data);
    }

    public function getSoal(Request $request){
        $idSoal = $request->idSoal;
        $noSoal = $request->noSoal;

        $indexSoal = $noSoal - 1;
        
        $getSoal = Soal::where('id', $idSoal)->first();

        $sizeBankSoal = BankSoal::where('soal_id', $idSoal)->count();

        if ($sizeBankSoal <= 0) {
            return response()->json([
                'message'   => 'Bank Soal Kosong!'
            ], 404);
        }

        $this->generateUjian($getSoal);

        $getUjian = Ujian::where('soal_id', $idSoal)
            ->where('user_id', $this->user->id)
            ->first();
        
        $listJawaban = json_decode($getUjian->list_jawaban, true); 
        
        $getBankSoal = BankSoal::where('id', $listJawaban[$indexSoal]['id_bank'])
            ->first();
        
        return response()->json([
            'pertanyaan'    => $getBankSoal->pertanyaan,
            'data_ujian'    => $listJawaban,
            'ujian_selesai' => $getUjian->waktu_selesai,
        ], 200);
    }

    public function update(Request $request){
        // dd($request->all());
        $noSoal = $request->noSoal;
        $idSoal = $request->idSoal;
        $idBank = $request->idBank;
        $jawabanPG = $request->jawabanPG;
        $query = Ujian::where('user_id', $this->user->id)
            ->where('soal_id', $idSoal)
            ->first();
        $dataUjian = json_decode($query->list_jawaban, true);
        
        foreach ($dataUjian as $key => $value) {
            if ($value['id_bank'] == $idBank) {
                $dataUjian[$key]['jawaban_pg'] = $jawabanPG;
            }
        }

        Ujian::where('user_id', $this->user->id)
            ->where('soal_id', $idSoal)
            ->update(['list_jawaban' => json_encode($dataUjian)]);
        
        return response()->json([
            "noSoal"    => $noSoal,
            "idSoal"    => $idSoal
        ], 201);
        
    }

    private function generateUjian($getSoal){
        $getUjian = Ujian::where('user_id', $this->user->id)
            ->where('soal_id', $getSoal->id)
            ->first();
        // dd($getSoal);
        if ($getUjian == null) {
            // dd($getSoal->acak);
            $getSoalUjian = $this->generateSoal($getSoal->acak, $getSoal->id);
            
            // dd($getSoal);
            $durasi = $getSoal->durasi;
            // dd($durasi);
            $dateTime = DateTime::createFromFormat('H:i:s', $durasi);

            $jam = $dateTime->format('G');
            $menit = $dateTime->format('i');

            $result = '+' . $jam . ' hours +' . $menit . ' minutes';

            $waktuSelesai = date("Y-m-d H:i:s", strtotime($getSoal->waktu_mulai.$result));

            $data = array(
                'user_id'   => $this->user->id,
                'soal_id'   => $getSoal->id,
                'list_jawaban'  => json_encode($getSoalUjian),
                'waktu_mulai'   => $getSoal->waktu_mulai,
                'waktu_selesai' => $waktuSelesai,
                'status_ujian'  => 'Belum',
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            );

            Ujian::insert($data);
        }
    }

    private function generateSoal($acak = 0, $id){
        if ($acak == 0) {
            $getBankSoal = BankSoal::where('soal_id', $id)
                ->get();
        } else {
            $getBankSoal = BankSoal::where('soal_id', $id)
                ->inRandomOrder()
                ->get();
        }

        foreach($getBankSoal as $key => $item) {
            $pilihan_pg = array($item->pilihan_a, $item->pilihan_b, $item->pilihan_c, $item->pilihan_d, $item->pilihan_e);
            $this->randomPG($pilihan_pg);
            $data[$key]['id_bank'] = $item->id;
            $data[$key]['jawaban_pg'] = null;
            $data[$key]['pilihan_pg'] = $pilihan_pg;
        }

        return $data;
    }

    private function randomPG(&$array){
        // algorithm is the Fisher-Yates shuffle
        $count = count($array);

        for ($i = $count - 1; $i > 0; $i--) {
            $j = mt_rand(0, $i);
            if ($j != $i) {
                // Swap elements at indices $i and $j
                $temp = $array[$i];
                $array[$i] = $array[$j];
                $array[$j] = $temp;
            }
        }
    }
}
