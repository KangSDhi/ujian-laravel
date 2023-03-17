<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AdminResource;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = "Dashboard Admin";
        $data['user'] = new AdminResource(auth()->user());
        return view("admin.dashboard", $data);
    }

    public function guru()
    {
        $data['title'] = "Data Guru";
        $data['user'] = new AdminResource(auth()->user());
        return view("admin.dataGuru", $data);
    }
}
