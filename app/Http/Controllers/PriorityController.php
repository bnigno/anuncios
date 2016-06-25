<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Priority;

class PriorityController extends Controller
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
       $priorities = Priority::orderby('priority','asc')->get();
       // dd($status);
       // $estados = Estados::select('cod_estados', 'sigla')->orderBy('sigla', 'asc')->get();
       return view('priority.index', compact('priorities')); 
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
        $priority = new Priority($formdata);
        $priority->save();
        return redirect('/admin/priority')->with('status', 'Categoria de prioridade cadastrada com sucesso.');
    }

   /**
     * Show the form for creating a new licitacao.
     *
     * @return Response
     */
    // public function getCidades($cod_estados)
    // {
    //        $cidades = Cidades::select('cod_cidades', 'nome')->where('estados_cod_estados', $cod_estados)->orderBy('nome', 'asc')->get();
    //        return json_encode( $cidades );
    // }


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
        $priority = Priority::where('id', $id)->get();
        $priority = $priority[0];

        return view('priority.create', compact('priority'));
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
        $priority = new Priority($formdata);
        $priority->where('id',$id)
                ->update(['name'=>$priority->name,'priority'=>$priority->priority]);

        return redirect("/admin/priority")->with('status', 'Categoria de prioridade editada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $priority = Priority::find($id);
        $priority::where('id',$id)->delete();
        return redirect('/admin/priority')->with('status', 'Categoria de prioridade excluída com sucesso.');
    }

    public function validateData($request){
    	$this->validate($request, [
    	    'name' => 'required|max:255,Nome'
    	]);
    }
}