<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;

class GuruController extends Controller
{
    public function getAllGuru()
    {
        $data = User::join('users_role', 'users.role_id', 'users_role.id')
            ->where('users_role.role', 'GURU')
            ->select('users.id', 'users.name', 'users.email', 'users_role.role')
            ->get();
        return response()->json([
            'success'   => true,
            'data'      => $data,
        ], Response::HTTP_OK);
    }
}
