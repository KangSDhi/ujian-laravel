<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $user;

    public function __construct(){
        if (!auth('jwt')->guest()) {
            $user = auth('api')->user();
            $this->user = $user;
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard Siswa";
        $data['user'] = $this->user;
        return view("siswa.dashboard", $data);
    }
}
