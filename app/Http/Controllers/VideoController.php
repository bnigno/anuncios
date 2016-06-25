<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Video;
use Storage;
use Response;

class VideoController extends Controller
{
    public function getVideo($fileName) {
        // return response()->file('storage/app/images/'.$fileName);
        $file = Storage::get('\images\\'.$fileName);
        $response = Response::make($file, 200);
        $response->header('Content-Type', 'video/mp4');
        return $response;
    }
}
