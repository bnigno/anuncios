<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\WebsiteElement;

class WebsiteElementsController extends Controller
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
       return view('websiteElements.index'); 
    }

   /**
     * Show the form for editing the usage terms.
     *
     * @return Response
     */
    public function getTerms()
    {
           $terms = WebsiteElement::all();
           if (sizeof($terms)>0){
               $terms = $terms[0];
           }
           return view('websiteElements.terms', compact('terms'));
    }


    /**
     * Update the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function postTerms(Request $request)
    {
        // $this->validateData($request);
        $formdata = $request->all();
        
        $terms = new WebsiteElement;
        // dd($terms[0]->terms);
        $terms->where('id',1)
                ->update(['terms'=>$formdata['terms']]);

        return redirect("/admin/elements")->with('status', 'Termos de uso editado com sucesso.');
    }

    /**
     * Show the form for editing the usage terms.
     *
     * @return Response
     */
    public function getAdvertise()
    {
           $advertise = WebsiteElement::all();
           if (sizeof($advertise)>0){
                $advertise = $advertise[0];
            }
           return view('websiteElements.advertise', compact('advertise'));
    }


    /**
     * Update the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function postAdvertise(Request $request)
    {
        // $this->validateData($request);
        $formdata = $request->all();
        
        $advertise = new WebsiteElement;
        // dd($terms[0]->terms);
        $advertise->where('id',1)
                ->update(['advertise'=>$formdata['advertise']]);

        return redirect("/admin/elements")->with('status', 'Seção de Anúncio editado com sucesso.');
    }

    public function validateData($request){
    	$this->validate($request, [
    	    'terms' => 'required|max:1000'
    	]);
    }
}