<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $data['title'] = "Landing Page Aplikasi Ujian";
        return view("landing.index", $data);
    }

    public function about()
    {
        $data['title'] = "About Page Aplikasi Ujian";
        return view("landing.about", $data);
    }
}
