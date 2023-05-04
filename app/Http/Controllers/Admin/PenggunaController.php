<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'namaLengkap'   => 'required',
            'email'         => 'required|email|unique:App\Models\User,email',
            'role'          => 'required',
            'password'      => 'required|min:10',
            'konfirmasiPassword'    => 'required|min:10|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => 'Validasi Error!',
                'data'      => $validator->errors()
            ], 500);
        } else {
            DB::beginTransaction();
            try {
                $pengguna = new User([
                    'name'  => $request->namaLengkap,
                    'email' => $request->email,
                    'password'  => bcrypt($request->password),
                    'role_id'   => $request->role
                ]);
    
                $pengguna->save();

                if ($pengguna->wasRecentlyCreated) {
                    DB::commit();
                } else {
                    DB::rollback();
                }
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'success'   => false,
                    'message'   => 'Gagal Menyimpan Data!',
                    'errors'    => $e->getMessage()
                ], 500);
            }
            return response()->json([
                'success'   => true,
                'message'   => 'Data Berhasil Tersimpan!'
            ], 201);
        }    
    }

    public function getPengguna($email){
        $query = User::where('email', $email)
            ->select('id', 'email', 'name', 'role_id')
            ->first();
        return response()->json([
            'success' => true,
            'message' => 'Mengambil Data Pengguna',
            'data'  => $query
        ]);
    }

    public function update(Request $request){
        $rule = array();
        $data = array();

        $rule['namaLengkap'] = 'required';
        $rule['email'] = 'required|email|unique:App\Models\User,email,'.$request->id;
        $rule['role'] = 'required';

        if ($request->password != null || $request->konfirmasiPassword != null) {
            $rule['password'] = 'required';
            $rule['konfirmasiPassword'] = 'required|same:password';
            $data['password'] = bcrypt($request->password);
        }
        
        $validator = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => 'Validasi Error!',
                'data'      => $validator->errors()
            ], 500);
        } else {
            DB::beginTransaction();
            try {
                $data['name'] = $request->namaLengkap;
                $data['email'] = $request->email;
                $data['role_id'] = $request->role;
                $pengguna = User::where('id', $request->id)
                    ->update($data);
                if ($pengguna == 1) {
                    DB::commit();
                } else {
                    DB::rollback();
                }
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'success'   => false,
                    'message'   => 'Gagal Menyimpan Data!',
                    'errors'    => $e->getMessage()
                ], 500);
            }

            return response()->json([
                'success'   => true,
                'message'   => 'Data Berhasil Di Update!'
            ], 201);   
        }
    }

    public function delete($email){
        $query = User::where('email', $email)->delete();
        
        if ($query == 1) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Menghapus Data Pengguna Email '.$email
            ], 200);
        }
    }
}
