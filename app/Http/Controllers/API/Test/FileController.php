<?php

namespace App\Http\Controllers\API\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use Carbon\Carbon;
use Response;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $response = array();
        $response['success'] = true;
        $response['message'] = "OK";
        $path = Storage::cloud()->put('files', $request->file('item'));
        $url = Storage::cloud()->temporaryUrl($path, Carbon::now()->addMinutes(1));

        $response['data'] = array(
            "url"   => $url,
            "path"  => $path
        );

        return Response::json($response, 201);
    }

    public function show(Request $request)
    {
        $response = array();
        $response['success'] = true;
        $response['message'] = "OK";
        $response['data'] = array(
            "url" => Storage::cloud()->temporaryUrl($request->path, Carbon::now()->addMinutes(1))
        );
        return Response::json($response, 201);
    }
}
