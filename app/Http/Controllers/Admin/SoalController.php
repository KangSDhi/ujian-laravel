<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal;
use Illuminate\Http\Response;

class SoalController extends Controller
{
    public function getAllSoal()
    {
        $data = Soal::select('nama_soal', 'butir_soal', 'acak')
            ->get();
        return response()->json([
            'success'   => true,
            'data'      => $data      
        ], Response::HTTP_OK);
    }
}
