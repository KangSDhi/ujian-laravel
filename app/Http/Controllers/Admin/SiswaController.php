<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;

class SiswaController extends Controller
{
    public function getAllSiswa()
    {
        $data = User::join('users_role', 'users.role_id', 'users_role.id')
            ->join('kelas', 'users.kelas_id', 'kelas.id')
            ->where('users_role.role', 'SISWA')
            ->select('users.id', 'users.name', 'users.email', 'users_role.role', 'kelas.tingkat', 'kelas.kelas')
            ->orderBy('kelas', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json([
            'success'   => true,
            'data'      => $data
        ], Response::HTTP_OK);
    }
}
