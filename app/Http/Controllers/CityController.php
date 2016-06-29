<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\City;
use App\Cidades;
use App\Estados;

class CityController extends Controller
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
       $cities = City::join('estados', 'cities.cod_estados', '=', 'estados.cod_estados')
                    ->join('cidades', 'cities.cod_cidades', '=', 'cidades.cod_cidades')
                    ->orderBy('sigla', 'asc')->orderBy('cidades.nome', 'asc')->get();
       $estados = Estados::select('cod_estados', 'sigla')->orderBy('sigla', 'asc')->get();
       return view('city.index', compact('cities','estados','status')); 
    }

    /**
     * Process the data and save a new licitacao.
     *
     * @return Response
     */
    public function postCreate(Request $request)
    {
        //$this->validateData($request);
        $formdata = $request->all();
        $city = new City($formdata);
        $city->save();
        return redirect('admin/city')->with('status', 'Cidade cadastrada com sucesso.');
    }

   /**
     * Show the form for creating a new licitacao.
     *
     * @return Response
     */
    public function getCidades($cod_estados)
    {
           $cidades = Cidades::select('cod_cidades', 'nome')->where('estados_cod_estados', $cod_estados)->orderBy('nome', 'asc')->get();
           return json_encode( $cidades );
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
        $city = City::where('id', $id)->get();
        $city = $city[0];

        return view('city.create', compact('city'));
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
        $formdata = $request->all();
        $city = new City($formdata);
        $city->where('id',$id)
                ->update(['name'=>$city->name]);

        return redirect('admin/city');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $city = City::find($id);
        $city::where('id',$id)->delete();
        return redirect('admin/city')->with('status', 'Cidade excluída com sucesso.');
    }

    public function validateData($request){
    	$this->validate($request, [
    	    'name' => 'required|max:255,Nome'
    	]);
    }
}
