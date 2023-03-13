<?php

namespace App\Http\Controllers\Error;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function accessDenied()
    {
        $data['title'] = "Access Denied";
        return view("error.accessDenied", $data);
    }
}
