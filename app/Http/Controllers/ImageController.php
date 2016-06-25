<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Request;
use Response;
use App\Partner;
use App\Photo;
use App\Video;
use App\Perfil;
use App\Cover;
use URL;
use Storage;
use Image;
 
class ImageController extends Controller {
 
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function postBanner() {
 
        $input = Input::all();
 
        $rules = array(
            'file' => 'image|max:5000',
        );
 
        $validation = Validator::make($input, $rules);
 
        if ($validation->fails()) {
            return Response::make($validation->errors->first(), 400);
        }
 
        $destinationPath = storage_path('app/images'); // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = sha1(time().time()) . '.' . $extension; // renameing image
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
 
        if ($upload_success) {
            $url = explode("/",URL::previous());
            // dd(end($url));
            $id = end($url);
            $partner = new Partner();
            $partner->where('id',$id)
                    ->update(['banner'=>$fileName]);
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }

    public function postImg() {
    
        $input = Input::all();
    
        $rules = array(
            'file' => 'image|max:5000',
        );
    
        $validation = Validator::make($input, $rules);
    
        if ($validation->fails()) {
            return Response::make($validation->errors->first(), 400);
        }
        $destinationPath = storage_path('app/images'); // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = sha1(time().time()) . '.' . $extension; // renameing image
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
        $img = Image::make(Storage::get('images/'.$fileName));
        $img->fit(140, 140);
        $img->save($destinationPath . '/thumb' . $fileName);

        if ($upload_success) {
            $url = explode("/",URL::previous());
            // dd(end($url));
            $id = end($url);
            $photo = new Photo();
            $photo->idAd = $id;
            $photo->fileName = $fileName;
            $photo->save();
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }

    public function postPerfil() {
    
        $input = Input::all();
    
        $rules = array(
            'file' => 'image|max:5000',
        );
    
        $validation = Validator::make($input, $rules);
    
        if ($validation->fails()) {
            return Response::make($validation->errors->first(), 400);
        }
        $destinationPath = storage_path('app/images'); // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = sha1(time().time()) . '.' . $extension; // renameing image
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
        $img = Image::make(Storage::get('images/'.$fileName));
        $img->fit(140, 140);
        $img->save($destinationPath . '/thumb' . $fileName);

        if ($upload_success) {
            $url = explode("/",URL::previous());
            // dd(end($url));
            $id = end($url);
            $perfil = Perfil::where('idAd', $id)->update(['perfilName' => $fileName]);
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }

    public function postCover() {
    
        $input = Input::all();
    
        $rules = array(
            'file' => 'image|max:5000',
        );
    
        $validation = Validator::make($input, $rules);
    
        if ($validation->fails()) {
            return Response::make($validation->errors->first(), 400);
        }
        $destinationPath = storage_path('app/images'); // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = sha1(time().time()) . '.' . $extension; // renameing image
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
        $img = Image::make(Storage::get('images/'.$fileName));
        $img->fit(140, 140);
        $img->save($destinationPath . '/thumb' . $fileName);

        if ($upload_success) {
            $url = explode("/",URL::previous());
            // dd(end($url));
            $id = end($url);
            $cover = Cover::where('idAd', $id)->update(['coverName' => $fileName]);
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }

    public function postVid() {
    
        $input = Input::all();
    
        // $rules = array(
        //     'file' => 'video|max:70000',
        // );
    
        // $validation = Validator::make($input, $rules);
    
        // if ($validation->fails()) {
        //     return Response::make($validation->errors->first(), 400);
        // }
    
        $destinationPath = storage_path('app/images'); // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = sha1(time().time()) . '.' . $extension; // renameing image
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
    
        if ($upload_success) {
            $url = explode("/",URL::previous());
            // dd(end($url));
            $id = end($url);
            $video = new Video();
            $video->idAd = $id;
            $video->fileName = $fileName;
            $video->save();
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }

    public function getDelete() {
        Storage::delete('images/'.$_GET['filename']);
        $partner = new Partner();
        $partner->where('banner',$_GET['filename'])
                ->update(['banner'=>'']);
        return back()->with('status', 'Imagem excluída com sucesso.');
    }

    public function getDeleteimg() {
        Storage::delete('images/'.$_GET['filename']);
        Storage::delete('images/thumb'.$_GET['filename']);
        $photo = Photo::where('filename',$_GET['filename'])->delete();
        return back()->with('status', 'Imagem excluída com sucesso.');
    }

    public function getDeleteperfil() {
        Storage::delete('images/'.$_GET['filename']);
        Storage::delete('images/thumb'.$_GET['filename']);
        $perfil = Perfil::where('perfilName',$_GET['filename'])->update(['perfilName' => '']);
        return back()->with('status', 'Imagem de perfil excluída com sucesso.');
    }

    public function getDeletecover() {
        Storage::delete('images/'.$_GET['filename']);
        Storage::delete('images/thumb'.$_GET['filename']);
        $cover = Cover::where('coverName',$_GET['filename'])->update(['coverName' => '']);
        return back()->with('status', 'Imagem de capa excluída com sucesso.');
    }

    public function getDeletevid() {
        Storage::delete('images/'.$_GET['filename']);
        $video = new Video();
        $video->where('filename',$_GET['filename'])
                ->delete();
        return back()->with('status', 'Vídeo excluído com sucesso.');
    }
 
}