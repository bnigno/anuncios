<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Partner;
use Storage;

class PartnerController extends Controller
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
       $partners = Partner::orderby('name','asc')->get();
       // dd($status);
       // $estados = Estados::select('cod_estados', 'sigla')->orderBy('sigla', 'asc')->get();
       return view('partner.index', compact('partners')); 
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
        $partner = new Partner($formdata);
        $partner->state = 0;
        // dd($partner);
        $partner->save();
        return redirect('/admin/partner/edit/'.$partner->id)->with('status', 'Parceiro cadastrado com sucesso.');
    }

   /**
     * Show the form for creating a new licitacao.
     *
     * @return Response
     */
    public function getCreate()
    {
       return view('partner.create');
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
        $partner = Partner::where('id', $id)->get();
        $partner = $partner[0];
        // dd($partner);
        return view('partner.create', compact('partner'));
    }

/**
     * Persists an edition on the database.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit($id, Request $request)
    {
    	// $this->validateData($request);
        $formdata = $request->all();
        $partner = new Partner($formdata);
        if ($partner->state == 1) {
        	$partner->where('id',$id)
	        		->update(['name'=>$partner->name, 'site'=>$partner->site,'state'=>1]);
        }else{
        	$partner->where('id',$id)
	        		->update(['name'=>$partner->name, 'site'=>$partner->site, 'state'=>0]);
        }
        

        return redirect("/admin/partner")->with('status', 'Parceiro editado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $partner = Partner::find($id);
        // dd($partner->banner);
        if ($partner->banner != ""){
            Storage::delete('images/'.$partner->banner);
        }
        $partner::where('id',$id)->delete();
        return redirect('partner')->with('status', 'Parceiro excluído com sucesso.');
    }

    public function validateData($request){
    	$this->validate($request, [
    	    'name' => 'required|max:255,Nome'
    	]);
    }
}