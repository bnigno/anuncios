<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\City;
use App\Ad;
use App\Priority;
use App\Photo;
use App\Video;
use App\Partner;
use App\WebsiteElement;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function getIndex(Request $request) {
        if ($request->session()->has('city')) {
            return redirect('/anuncios/cidade/'.$request->session()->get('city'));
        } else {
        	$cities = City::join('cidades', 'cities.cod_cidades', '=', 'cidades.cod_cidades')->orderby('cidades.nome','asc')->get();
        	if (sizeof($cities)>0) {
        		return view('visitor.index', compact('cities')); 
        	} else {
        		return view('visitor.nocity');
        	}
        }
    }

    public function postCidade(Request $request)
    {
    	$city = $request->get('city');
    	$request->session()->put('city', $city);
    	return redirect('/anuncios/cidade/'.$request->session()->get('city'));
    }

    public function getCidade(Request $request, $id)
    {
        if (!$request->session()->has('city')) {
            return redirect('/anuncios/');
        }
        $city = City::join('cidades', 'cities.cod_cidades', '=', 'cidades.cod_cidades')->where('id', $id)->get();
        $city = $city[0];
        $city->nome = mb_strtolower($city->nome, 'UTF-8');
        $city->nome = ucwords($city->nome);
        // dd($city->nome);
    	$today = Carbon::today();
    	
		$names = Ad::select('ads.*', 'cover.coverName', 'perfil.perfilName')
        ->join('ads_cities', 'ads_cities.idAds', '=', 'ads.id')
        ->join('cover', 'ads.id', '=', 'cover.idAd')
        ->join('perfil', 'ads.id', '=', 'perfil.idAd')
        ->where('ads_cities.idCities', $id)
        ->where('startDate', '<=', $today)
        ->where('endDate', '>=', $today)
        ->orderby('ads.name','asc')->get();

        $featureds = Ad::select('ads.*', 'cover.coverName', 'perfil.perfilName')
        ->join('ads_cities', 'ads_cities.idAds', '=', 'ads.id')
        ->join('cover', 'ads.id', '=', 'cover.idAd')
        ->join('perfil', 'ads.id', '=', 'perfil.idAd')
        ->where('ads_cities.idCities', $id)
        ->where('startDate', '<=', $today)
        ->where('endDate', '>=', $today)
        ->where('featured', 1)
        ->orderby('ads.name','asc')->get();

        $times = Ad::select('ads.*', 'cover.coverName', 'perfil.perfilName')
        ->join('ads_cities', 'ads_cities.idAds', '=', 'ads.id')
        ->join('cover', 'ads.id', '=', 'cover.idAd')
        ->join('perfil', 'ads.id', '=', 'perfil.idAd')
        ->where('ads_cities.idCities', $id)
        ->where('startDate', '<=', $today)
        ->where('endDate', '>=', $today)
        ->orderby('ads.startDate','desc')
        ->take(9)->get();
    	
		return view('visitor.anuncios', compact('names', 'city', 'featureds', 'times'));
    }

    public function getAcompanhante($id)
    {
        $ad = Ad::leftJoin('perfil', 'perfil.idAd', '=', 'ads.id')
        ->leftJoin('cover', 'cover.idAd', '=', 'ads.id')
        ->leftJoin('videos', 'videos.idAd', '=', 'ads.id')
        ->where('ads.id', $id)->get();
        if (isset($ad[0])) {
            $ad = $ad[0];
        }

        
        $photos = Photo::where('idAd', $id)->get();
        $video = Video::where('idAd', $id)->get();
        if (isset($video[0])) {
            $video = $video[0];
        }

        $city = City::join('cidades', 'cities.cod_cidades', '=', 'cidades.cod_cidades')
        ->leftjoin('ads_cities', 'ads_cities.idCities', '=', 'cities.id')
        ->where('ads_cities.idAds', $id)->get();
        $city = $city[0];
        $city->nome = mb_strtolower($city->nome, 'UTF-8');
        $city->nome = ucwords($city->nome);

        $partners = Partner::where('state', '1')->get();
        return view('visitor.anuncio', compact('ad', 'photos', 'city', 'video', 'partners'));
    }

    public function getAlterar(Request $request) {
        $request->session()->forget('city');
        return redirect('/');
    }

    public function getTermos()
    {
        $terms = WebsiteElement::select('terms')->where('id', 1)->get();
        if (isset($terms[0])) {
            $terms = $terms[0];
        }
        $title = 'Termos de uso';
        $terms->terms = str_replace('<p>', '<p class="text-theme lead">', $terms->terms);
        return view('visitor.termos', compact('terms', 'title'));
    }

    public function getAnuncie()
    {
        $terms = WebsiteElement::select('advertise')->where('id', 1)->get();
        if (isset($terms[0])) {
            $terms = $terms[0];
        }
        $title = 'Anuncie';
        $terms->advertise = str_replace('<p>', '<p class="text-theme lead">', $terms->advertise);
        return view('visitor.termos', compact('terms', 'title'));
    }

    public function getContato()
    {
        $partners = Partner::where('state', '1')->get();
        return view('visitor.contato', compact('partners'));
        
    }

    public function postContato()
    {
        $to = "bnigno_16@msn.com";
        $from = $_REQUEST['email'];
        $name = $_REQUEST['name'];
        $headers = "From: $from";
        $subject = "You have a message.";

        $fields = array();
        $fields{"name"} = "name";
        $fields{"email"} = "email";
        $fields{"message"} = "message";

        $body = "Here is what was sent:\n\n"; foreach($fields as $a => $b){   $body .= sprintf("%s: %s\n",$b,$_REQUEST[$a]); }

        $send = mail($to, $subject, $body, $headers);
        dd($send);
        return redirect('/anuncios/contato');

    }

    public function getPesquisar(Request $request)
    {
        if (!$request->session()->has('city')) {
            return redirect('/anuncios/');
        }
        $id = $request->session()->get('city');
        $name = '';
        $eyeColor = '';
        $hairColor = '';
        if (isset($_REQUEST['name'])) {
            $name  = $_REQUEST['name'];
        }
        if (isset($_REQUEST['eyeColor'])) {
            $eyeColor  = $_REQUEST['eyeColor'];
        }
        if (isset($_REQUEST['hairColor'])) {
            $hairColor  = $_REQUEST['hairColor'];
        }
        $oral = '%';
        $anal = '%';
        $kiss = '%';
        if (isset($_REQUEST['oral'])) {
            $oral  = $_REQUEST['oral'];
        }
        if (isset($_REQUEST['anal'])) {
            $anal  = $_REQUEST['anal'];
        }
        if (isset($_REQUEST['kiss'])) {
            $kiss  = $_REQUEST['kiss'];
        }
        $city = City::join('cidades', 'cities.cod_cidades', '=', 'cidades.cod_cidades')->where('id', $id)->get();
        $city = $city[0];
        $city->nome = mb_strtolower($city->nome, 'UTF-8');
        $city->nome = ucwords($city->nome);
        // dd($city->nome);
        $today = Carbon::today();
        $ads = Ad::select('ads.*', 'cover.coverName', 'perfil.perfilName')
        // ->join('priorities', 'priorities.id', '=', 'ads.idPriority')
        ->join('ads_cities', 'ads_cities.idAds', '=', 'ads.id')
        ->join('cover', 'ads.id', '=', 'cover.idAd')
        ->join('perfil', 'ads.id', '=', 'perfil.idAd')
        ->where('ads_cities.idCities', $id)
        // ->where('priorities.priority', $i)
        ->where('startDate', '<=', $today)
        ->where('endDate', '>=', $today)
        ->where([['ads.name', 'like', '%'.$name.'%'], ['ads.eyeColor', 'like', '%'.$eyeColor.'%'], ['ads.hairColor', 'like', '%'.$hairColor.'%'], ['ads.anal', 'like', $anal], ['ads.oral', 'like', $oral], ['ads.kiss', 'like', $kiss]])->get();
        // ->when($oral, function ($query) {
        //     return $query->where('ads.oral', 1);})
        // ->when($anal, function ($query) {
        //     return $query->where('ads.anal', 1);})
        // ->when($kiss, function ($query) {
        //     return $query->where('ads.kiss', 1);})
        // ->orderby('ads.name','asc');
        // if (isset($oral)) {
        //     $ads->where('ads.oral', 1);
        // }
        // $ads->get();
        
        //$priorities = Priority::join('ads', 'ads.idPriority', '=', 'priorities.id')->get();
        // dd($ads);
        $partners = Partner::where('state', '1')->get();

        return view('visitor.pesquisar', compact('ads', 'city', 'partners'));
    }
}
