<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AdminResource;
use App\Http\Resources\GuruResource;
use App\Http\Resources\SiswaResource;

class AuthController extends Controller
{
    public function index()
    {
        $data['title'] = "Login Page";

        return view("auth.login", $data);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emailAtauNISN' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (filter_var($request->emailAtauNISN, FILTER_VALIDATE_EMAIL)) {
            $credentials = array(
                'email'  => $request->emailAtauNISN,
                'password' => $request->password,
            );
        }else{
            $credentials = array(
                'NISN'  => $request->emailAtauNISN,
                'password' => $request->password,
            );
        }

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email, NISN atau Password Salah!'
            ], 401);
        }

        $user = auth()->guard('api')->user();

        if ($user->role_id == 1) {
            $link = "dashboardadmin";
            $data = new AdminResource($user);
        } else if ($user->role_id == 2) {
            $link = "dashboardguru";
            $data = new GuruResource($user);
        } else {
            $link = "dashboardsiswa";
            $data = new SiswaResource($user);
        }

        return response()->json([
            'success'   => true,
            'user'      => $data,
            'link'      => $link,
            'token'     => $token
        ], 200);
    }
}
