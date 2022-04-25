<?php

namespace App\Http\Controllers\Auxiliaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Auxiliaries\ToxicologicalClass;

class ToxicologicalClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

   $toxicologicalClasses = auth()->user()->toxicologicalClass()->get();
  
        return view('auxiliaries.toxicologicalClass.index', ['toxicologicalClasses' => $toxicologicalClasses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $toxicologicalClass= new \App\Models\Auxiliaries\ToxicologicalClass ([


        ]);

        return view('auxiliaries.toxicologicalClass.create',compact('toxicologicalClass'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ToxicologicalClass  $toxicologicalClass)
    {
        if ($request['note'] == null){
            $request['note'] = ".";
         }

         if ($request['description'] == null){
            $request['description'] = ".";
         }

        $data = $this->validateRequest();

     
        $toxicologicalClass= new toxicologicalClass();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $toxicologicalClass->storetoxicologicalClass($data);

        if ($response)

        return redirect()
                        ->route('toxicologicalClass.create')
                        ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar o tipo de atividade');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(toxicologicalClass$toxicologicalClass)
    {

        return view('auxiliaries.toxicologicalClass.show', compact('toxicologicalClass' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(toxicologicalClass$toxicologicalClass) {


        $user = auth()->user();


        return view('auxiliaries.toxicologicalClass.edit',['toxicologicalClass' => $toxicologicalClass]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToxicologicalClass  $toxicologicalClass)
    {

       $dataRequest = $request; 

   
    $data['name']           = $dataRequest['name'];
    $data['description']    = $dataRequest['description'];
    $data['note']           = $dataRequest['note'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $toxicologicalClass-> update($data);

      if ($update){

        return redirect()
                        ->route('toxicologicalClass.edit' ,[ 'toxicologicalClass' => $toxicologicalClass->id ])
                        ->with('sucess', 'Sucesso ao atualizar');
      }     
    
        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização do tipo de atividade');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToxicologicalClass  $toxicologicalClass)
    {
  
        $destroy = $toxicologicalClass->delete();
      

        if ($destroy)
        {
          //  dd($destroy);
              return redirect()
                              ->route('toxicologicalClass.index')
                              ->with('sucess', 'A variedade '. $toxicologicalClass->name . ' foi deletada com sucesso');
                      
  
              return redirect()
                      ->back()
                      ->with('error',  'Falha na deleção a variedade');
  
          }
    }

    private function validateRequest()
    {

        return request()->validate([

        
            'name'          => 'required',
            'description'   => 'required',
            'note'          => 'required',
            'in_use'        => 'required',
            
            
       ]);

    }
}
