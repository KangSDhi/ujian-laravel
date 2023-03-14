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
}
