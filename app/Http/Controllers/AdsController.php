<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Ad;
use App\Priority;
use App\City;
use App\Photo;
use App\Video;
use App\Ad_City;
use App\Perfil;
use App\Cover;
use Storage;
use Carbon\Carbon;

class AdsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of licitacao.
     *
     * @return Response
     */
    public function getIndex()
    {
       $ads = Ad::join('ads_cities', 'ads.id', '=', 'ads_cities.idAds')->join('cities', 'cities.id', '=', 'ads_cities.idCities')->join('cidades', 'cities.cod_cidades', '=', 'cidades.cod_cidades')->select('ads.name', 'ads.id', 'cidades.nome')->orderby('name','asc')->get();
        $cities = City::join('cidades', 'cities.cod_cidades', '=', 'cidades.cod_cidades')->orderby('cidades.nome','asc')->get();

       // dd($ads);
       // $estados = Estados::select('cod_estados', 'sigla')->orderBy('sigla', 'asc')->get();
       return view('ads.index', compact('ads', 'cities'));
    }

    /**
     * Process the data and save a new licitacao.
     *
     * @return Response
     */
    public function postCreate(Request $request)
    {
        $this->validateData($request);
        $formdata = $request->except('idCity');
        // dd($formdata);
        $ad = new Ad($formdata);
        if (!isset($ad->featured)) {
                $ad->featured=0;
        };
        if (!isset($ad->travel)) {
        	$ad->travel=0;
        };
        if (!isset($ad->oral)) {
        	$ad->oral=0;
        };
        if (!isset($ad->anal)) {
        	$ad->anal=0;
        };
        if (!isset($ad->kiss)) {
        	$ad->kiss=0;
        };
        $ad->save();
        $adsCities = new ad_City;
        $adsCities->idCities = $request->input('idCity');
        $adsCities->idAds = $ad->id;
        $adsCities->save();
        $perfil = new Perfil;
        $perfil->idAd = $ad->id;
        $perfil->save();
        $cover = new Cover;
        $cover->idAd = $ad->id;
        $cover->save();
        return redirect('admin/ads/midia/'.$ad->id)->with('status', 'Anúncio cadastrado com sucesso. Adicione imagens e vídeo para o anúncio.');
    }

   /**
     * Show the form for creating a new licitacao.
     *
     * @return Response
     */
    public function getCreate()
    {
    	$cities = City::join('cidades', 'cities.cod_cidades', '=', 'cidades.cod_cidades')->orderby('cidades.nome','asc')->get();
    	// dd($cities);
		return view('ads.create', compact('cities'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $ad = Ad::where('id', $id)->get();
        $ad = $ad[0];
        $city = Ad_City::where('idAds', $id)->select('idCities')->get();
        $ad->idCity = $city[0]['idCities'];
        // $ad->startDate = Carbon::createFromFormat('Y-m-d', $ad->startDate)->format('d/m/Y');
        // $ad->endDate = Carbon::createFromFormat('Y-m-d', $ad->endDate)->format('d/m/Y');
        $cities = City::join('cidades', 'cities.cod_cidades', '=', 'cidades.cod_cidades')->orderby('cidades.nome','asc')->get();
        // dd($ad);
        return view('ads.create', compact('ad','cities'));
    }

/**
     * Persists an edition on the database.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit($id, Request $request)
    {
    	$this->validateData($request);
    	$formdata = $request->except('idCity');
        // dd($formdata);
        $ad = new Ad($formdata);
        // $ad->startDate = Carbon::createFromFormat('d/m/Y', $ad->startDate);
        // $ad->endDate = Carbon::createFromFormat('d/m/Y', $ad->endDate);
        // $ad->createdDate = Carbon::now();
        if (!isset($ad->featured)) {
                $ad->featured=0;
        };
        if (!isset($ad->travel)) {
        	$ad->travel=0;
        };
        if (!isset($ad->oral)) {
        	$ad->oral=0;
        };
        if (!isset($ad->anal)) {
        	$ad->anal=0;
        };
        if (!isset($ad->kiss)) {
        	$ad->kiss=0;
        };
        // $ad->state = 0;
       	// dd($ad);
        $ad->where('id', $id)->update(['name' => $ad->name, 'price' => $ad->price, 'bornCity' => $ad->bornCity, 'service' => $ad->service, 'weight' => $ad->weight, 'height' => $ad->height, 'hairColor' => $ad->hairColor, 'eyeColor' => $ad->eyeColor, 'race' => $ad->race, 'age' => $ad->age, 'size' => $ad->size, 'hip' => $ad->hip, 'travel' => $ad->travel, 'description' => $ad->description, 'oral' => $ad->oral, 'anal' => $ad->anal, 'kiss' => $ad->kiss, 'startDate' => $ad->startDate, 'endDate' => $ad->endDate, 'featured' => $ad->featured]);
        $adsCities = new ad_City;
        $adsCities->idCities = $request->input('idCity');
        $adsCities->idAds = $ad->id;
        $adsCities->where('idAds', $id)->update(['idCities' => $adsCities->idCities]);
        return redirect('admin/ads/edit/'.$id)->with('status', 'Anúncio editado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $ad = Ad::find($id);
        // Storage::delete('images/'.$ad->banner);
        $adsCities = Ad_City::where('idAds',$id)->delete();
        $ad::where('id',$id)->delete();
        return redirect('ads')->with('status', 'Anúncio excluído com sucesso.');
    }

    public function validateData($request){
    	$this->validate($request, [
    	    'endDate' => 'required|date|after:startDate'
    	]);
    }

    public function getMidia($id)
    {
        $perfil = Perfil::where('perfil.idAd', $id)->get();
        $perfil = $perfil[0];
        $cover = Cover::where('cover.idAd', $id)->get();
        $cover = $cover[0];
        $photos = Photo::where('idAd', $id)->get();
        $videos = Video::where('idAd', $id)->get();
        $ad = Ad::where('id', $id)->get();
        $ad = $ad[0];
        
        // Storage::delete('images/'.$ad->banner);
        // dd(compact('perfil')); 
        return view('ads.midia', compact('photos', 'videos', 'perfil', 'cover', 'ad'));
    }

    public function getSearch()
    {
        // dd($_GET);
        $cityId = '%';
        $name = '';
        if (isset($_GET['name'])) {
            $name = $_GET['name'];
        };
        if (isset($_GET['city'])) {
            $cityId = $_GET['city'];
        };
        $cities = City::join('cidades', 'cities.cod_cidades', '=', 'cidades.cod_cidades')->orderby('cidades.nome','asc')->get();

        $ads = Ad::join('ads_cities', 'ads.id', '=', 'ads_cities.idAds')
            ->join('cities', 'cities.id', '=', 'ads_cities.idCities')
            ->join('cidades', 'cities.cod_cidades', '=', 'cidades.cod_cidades')
            ->select('ads.name', 'ads.id', 'cidades.nome')
            ->where([['ads.name', 'like', '%'.$name.'%'], ['cities.id', 'like', $cityId]])
            ->orderby('name','asc')->get();
        
        // Storage::delete('images/'.$ad->banner);
        // dd(compact('perfil'));
       return view('ads.index', compact('ads', 'cities'));

    }
}