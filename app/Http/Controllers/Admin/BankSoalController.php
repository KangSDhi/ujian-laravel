<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\BankSoal;

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
        return response()->json($bankSoal, 200);
    }
}
