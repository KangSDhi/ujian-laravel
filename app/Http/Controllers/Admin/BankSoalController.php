<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\BankSoal;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BankSoalController extends Controller
{
    private $user;

    public function __construct(){
        if (!auth('jwt')->guest()) {
            $user = auth('jwt')->user();
            $this->user = $user;
        }
    }

    public function index($idSoal){
        $soal = Soal::where('id', $idSoal)->first();
        $data['title'] = "Soal ".$soal->nama_soal;
        $data['user'] = $this->user;
        $data['idSoal'] = $idSoal;
        return view('admin.soal', $data);
    }

    public function getSoalInBankSoal(Request $request){
        $bankSoal = BankSoal::where('soal_id', $request->idSoal)
            ->get();
        
        $data = array();

        foreach ($bankSoal as $key => $value) {
            $bankSoal[$key]['gambar_pertanyaan_path'] = null;
            $bankSoal[$key]['gambar_pilihan_a_path'] = null;
            $bankSoal[$key]['gambar_pilihan_b_path'] = null;
            $bankSoal[$key]['gambar_pilihan_c_path'] = null;
            $bankSoal[$key]['gambar_pilihan_d_path'] = null;
            $bankSoal[$key]['gambar_pilihan_e_path'] = null;

            if ($value->gambar_pertanyaan != null) {
                $bankSoal[$key]['gambar_pertanyaan_path'] =  Storage::cloud()->temporaryUrl($value->gambar_pertanyaan, Carbon::now()->addMinutes(1));
            } 

            if (str_contains($value->pilihan_a, 'gambar_pilihan/')) {
                $bankSoal[$key]['gambar_pilihan_a_path'] = Storage::cloud()->temporaryUrl($value->pilihan_a, Carbon::now()->addMinutes(1));
            }

            if (str_contains($value->pilihan_b, 'gambar_pilihan/')) {
                $bankSoal[$key]['gambar_pilihan_b_path'] = Storage::cloud()->temporaryUrl($value->pilihan_b, Carbon::now()->addMinutes(1));
            }

            if (str_contains($value->pilihan_c, 'gambar_pilihan/')) {
                $bankSoal[$key]['gambar_pilihan_c_path'] = Storage::cloud()->temporaryUrl($value->pilihan_c, Carbon::now()->addMinutes(1));
            }

            if (str_contains($value->pilihan_d, 'gambar_pilihan/')) {
                $bankSoal[$key]['gambar_pilihan_d_path'] = Storage::cloud()->temporaryUrl($value->pilihan_d, Carbon::now()->addMinutes(1));
            }

            if (str_contains($value->pilihan_e, 'gambar_pilihan/')) {
                $bankSoal[$key]['gambar_pilihan_e_path'] = Storage::cloud()->temporaryUrl($value->pilihan_e, Carbon::now()->addMinutes(1));
            }
        }

        return response()->json($bankSoal, 200);
    }

    public function uploadGambarPertanyaan(Request $request){
        $fileGambarPertanyaan = $request->file('gambar_pertanyaan');
        $path = Storage::cloud()->put('gambar_pertanyaan', $fileGambarPertanyaan);
        $url = Storage::cloud()->temporaryUrl($path, Carbon::now()->addMinutes(1));

        return response()->json([
            'success'   => true,
            'message'   => 'Berhasil Upload Gambar Pertanyaan',
            'data'      => [
                'url'   => $url,
                'path'  => $path
            ],
        ], 201);
    }

    public function uploadGambarPilihan(Request $request){
        $fileGambarPilihan = $request->file('gambar_pilihan');
        $path = Storage::cloud()->put('gambar_pilihan', $fileGambarPilihan);
        $url = Storage::cloud()->temporaryUrl($path, Carbon::now()->addMinutes(1));

        return response()->json([
            'success'   => true,
            'message'   => 'Berhasil Upload Gambar Pilihan',
            'data'      => [
                'url'   => $url,
                'path'  => $path
            ],
        ], 201);
    }

    public function store(Request $request){

        $rules = array(
            'id_soal'     => 'required',
            'tipe_soal'   => 'required',
            'pertanyaan'  => Rule::requiredIf($request->gambar_pertanyaan == null),
            'pilihan_a'   => 'required',
            'pilihan_b'   => 'required',
            'pilihan_c'   => 'required',
            'pilihan_d'   => 'required',
            'pilihan_e'   => 'required',
            'nilai_a'     => 'required',
            'nilai_b'     => 'required',
            'nilai_c'     => 'required',
            'nilai_d'     => 'required',
            'nilai_e'     => 'required',
        );

        $messages = array(
            'id_soal.required'      => 'Mohon Masukan ID Soal!',
            'tipe_soal.required'    => 'Mohon Masukan Tipe Soal!',
            'pertanyaan.required'   => 'Mohon Isi Pertanyaan!', 
            'pilihan_a.required'    => 'Mohon Isi Pilihan A!',
            'pilihan_b.required'    => 'Mohon Isi Pilihan B!',
            'pilihan_c.required'    => 'Mohon Isi Pilihan C!',
            'pilihan_d.required'    => 'Mohon Isi Pilihan D!',
            'pilihan_e.required'    => 'Mohon Isi Pilihan E!',
            'nilai_a.required'      => 'Mohon Isi Nilai A!',
            'nilai_b.required'      => 'Mohon Isi Nilai B!',
            'nilai_c.required'      => 'Mohon Isi Nilai C!',
            'nilai_d.required'      => 'Mohon Isi Nilai D!',
            'nilai_e.required'      => 'Mohon Isi Nilai E!',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'soal_id'       => $request->id_soal,
            'tipe'          => $request->tipe_soal,
            'gambar_pertanyaan' => $request->gambar_pertanyaan,
            'pertanyaan'    => $request->pertanyaan,
            'pilihan_a'     => $request->pilihan_a,
            'pilihan_b'     => $request->pilihan_b,
            'pilihan_c'     => $request->pilihan_c,
            'pilihan_d'     => $request->pilihan_d,
            'pilihan_e'     => $request->pilihan_e,
            'nilai_a'     => $request->nilai_a,
            'nilai_b'     => $request->nilai_b,
            'nilai_c'     => $request->nilai_c,
            'nilai_d'     => $request->nilai_d,
            'nilai_e'     => $request->nilai_e,
        ];

        DB::beginTransaction();

        try {
            BankSoal::create($data);

            DB::commit();
        } catch(Exception $e){
            DB::rollback();

            return response()->json([
                'success'   => false,
                'errors'    => $e->getMessages()
            ], 500);
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Berhasil Menambahkan Soal'
        ], 201);
    }

    public function update(Request $request){

        $rules = array(
            'tipe'        => 'required',
            'pertanyaan'  => Rule::requiredIf($request->gambar_pertanyaan == null),
            'pilihan_a'   => 'required',
            'pilihan_b'   => 'required',
            'pilihan_c'   => 'required',
            'pilihan_d'   => 'required',
            'pilihan_e'   => 'required',
            'nilai_a'     => 'required',
            'nilai_b'     => 'required',
            'nilai_c'     => 'required',
            'nilai_d'     => 'required',
            'nilai_e'     => 'required',
        );

        $messages = array(
            'tipe.required'         => 'Mohon Masukan Tipe Soal!',
            'pertanyaan.required'   => 'Mohon Isi Pertanyaan!', 
            'pilihan_a.required'    => 'Mohon Isi Pilihan A!',
            'pilihan_b.required'    => 'Mohon Isi Pilihan B!',
            'pilihan_c.required'    => 'Mohon Isi Pilihan C!',
            'pilihan_d.required'    => 'Mohon Isi Pilihan D!',
            'pilihan_e.required'    => 'Mohon Isi Pilihan E!',
            'nilai_a.required'      => 'Mohon Isi Nilai A!',
            'nilai_b.required'      => 'Mohon Isi Nilai B!',
            'nilai_c.required'      => 'Mohon Isi Nilai C!',
            'nilai_d.required'      => 'Mohon Isi Nilai D!',
            'nilai_e.required'      => 'Mohon Isi Nilai E!',
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $data = BankSoal::where('id', $request->id)
            ->update([
                'tipe'  => $request->tipe,
                'gambar_pertanyaan' => $request->gambar_pertanyaan,
                'pertanyaan'    => $request->pertanyaan,
                'pilihan_a' => $request->pilihan_a,
                'pilihan_b' => $request->pilihan_b,
                'pilihan_c' => $request->pilihan_c,
                'pilihan_d' => $request->pilihan_d,
                'pilihan_e' => $request->pilihan_e,
                'nilai_a'   => $request->nilai_a,
                'nilai_b'   => $request->nilai_b,
                'nilai_c'   => $request->nilai_c,
                'nilai_d'   => $request->nilai_d,
                'nilai_e'   => $request->nilai_e,
            ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Berhasil Mengubah Data!'
        ], 201);
    }
}
