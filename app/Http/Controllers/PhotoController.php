<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use File;

use Input;
use Validator;

class PhotoController extends Controller
{
    public function postBanner(Request $request){
    		//dd($request);
    		$input = $request->file('banner');
    		$rules = array(
    		    'file' => 'image|max:3000',
    		);

    		$validation = Validator::make($input, $rules);

    		if ($validation->fails())
    		{
    			return Response::make($validation->errors->first(), 400);
    		}

    		$file = Input::file('file');

            $extension = File::extension($file['name']);
            $directory = path('public').'uploads/'.sha1(time());
            $filename = sha1(time().time()).".{$extension}";

            $upload_success = Input::upload('file', $directory, $filename);

            if( $upload_success ) {
            	return Response::json('success', 200);
            } else {
            	return Response::json('error', 400);
            }
    	}
}
