<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'         => 'required|email',
            'password'      => 'required'
        ], [
            'email.required'    => 'Mohon Isi Form Email!',
            'password.required' => 'Mohon Isi Form Password!'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'errors'    => $validator->errors()
            ], 422);
        }

        $credentials = array(
            'email'     => $request->email,
            'password'  => $request->password
        );

        if(!$token = auth()->guard('api')->setTTL(1440)->attempt($credentials)){
            return response()->json([
                'success'   => false,
                'message'   => 'Email Atau Password Salah!'
            ], 401);
        }

        return response()->json([
            'success'   => true,
            'token'     => $token
        ], 200);
    }

    public function checkAuth(){
        if (auth()->guard('api')->guest()) {
            return response()->json([
                'success'   => false,
                'message'   => 'Unauthorized'
            ], 401);
        }

        $roleId = auth()->guard('api')->user()->role_id;
        $role = null;

        switch ($roleId) {
            case 1:
                $role = "Admin";
                break;
            case 2:
                $role = "Guru";
                break;
            case 3:
                $role = "Siswa";
                break;
            default:
                $role = null;
                break;
        }

        return response()->json([
            'success'   => true,
            'data'      => [
                'role'  => $role
            ],
        ], 200);
    }
}
