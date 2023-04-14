<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;

class PenggunaController extends Controller
{
    private $user;

    public function __construct()
    {
        $user = auth('api')->user();
        $this->user = $user;
    }

    public function getAllPengguna()
    {
        $idAdmin = $this->user->id;
        $data = User::join('users_role', 'users.role_id', 'users_role.id')
            ->where('users.id', '!=', $idAdmin)
            ->where('users_role.role', '!=', 'SISWA')
            ->select('users.id', 'users.name', 'users.email', 'users_role.role')
            ->get();
        return response()->json([
            'success'   => true,
            'data'      => $data
        ], Response::HTTP_OK);
    }
}
