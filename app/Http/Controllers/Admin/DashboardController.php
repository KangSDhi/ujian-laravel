<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersRole;

class DashboardController extends Controller
{
    private $user;

    public function __construct(){
        $user = auth('api')->user()
            ->select('name', 'email')
            ->first();
        $this->user = $user;
    }

    public function index()
    {
        $data['title'] = "Dashboard Admin";
        $data['user'] = $this->user;
        return view("admin.dashboard", $data);
    }

    public function pengguna()
    {
        $data['title'] = "Data Pengguna";
        $data['user'] = $this->user;
        $data['dataUsersRole'] = UsersRole::where('role', '!=', 'SISWA')
            ->orderBy('role', 'desc')
            ->get();
        return view("admin.dataPengguna", $data);
    }

    public function siswa()
    {
        $data['title'] = "Data Siswa";
        $data['user'] = $this->user;
        return view("admin.dataSiswa", $data);
    }

    public function soal()
    {
        $data['title'] = "Data Soal";
        $data['user'] = $this->user;
        return view("admin.dataSoal", $data);
    }
}
