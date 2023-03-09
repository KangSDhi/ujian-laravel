<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        $data['title'] = "Login Page";

        return view("auth.login", $data);
    }

    public function login(Request $request)
    {
        return response()->json($request->all(), 201);
    }
}
