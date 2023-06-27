<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class DashboardController extends Controller
{
    private $user;

    public function __construct(){
        if (!auth('jwt')->guest()) {
            $user = auth('api')->user();
            $getUser = User::join('kelas', 'users.kelas_id', 'kelas.id')
                ->where('users.id', $user->id)
                ->first();
            $this->user = $getUser;
        }
    }

    public function index(): View
    {
        $data['title'] = "Dashboard Siswa";
        $data['user'] = $this->user;
        return view("siswa.dashboard", $data);
    }

    public function soal(): view
    {
        $data['title'] = "Halaman Soal";
        $data['user'] = $this->user;
        return view("siswa.daftarSoal", $data);
    }
}
