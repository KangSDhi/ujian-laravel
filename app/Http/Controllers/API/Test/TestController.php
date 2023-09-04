<?php

namespace App\Http\Controllers\API\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TestController extends Controller
{
    public function getDataSiswaTest(){
        $query = User::where('role_id', 3)->get();
        // return response()->json([
        //     'data' => $query
        // ]);
        dd($query);
    }
}
