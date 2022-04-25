<?php

namespace App\Http\Controllers\Auxiliaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Auxiliaries\FormulationType;

class FormulationTypeController extends Controller
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

   $formulationTypees = FormulationType::get();
  
        return view('auxiliaries.formulationType.index', ['formulationTypees' => $formulationTypees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $formulationType = new \App\Models\Auxiliaries\FormulationType([


        ]);

        return view('auxiliaries.formulationType.create',compact('formulationType'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormulationType $formulationType)
    {
        if ($request['note'] == null){
            $request['note'] = ".";
         }

         if ($request['description'] == null){
            $request['description'] = ".";
         }

        $data = $this->validateRequest();

     
        $formulationType = new formulationType();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $formulationType->storeformulationType($data);

        if ($response)

        return redirect()
                        ->route('formulationType.create')
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
    public function show(formulationType $formulationType)
    {

        return view('auxiliaries.formulationType.show', compact('formulationType' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(formulationType $formulationType) {


        $user = auth()->user();


        return view('auxiliaries.formulationType.edit',['formulationType' => $formulationType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormulationType $formulationType)
    {

       $dataRequest = $request; 

   
    $data['name']           = $dataRequest['name'];
    $data['description']    = $dataRequest['description'];
    $data['note']           = $dataRequest['note'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $formulationType -> update($data);

      if ($update){

        return redirect()
                        ->route('formulationType.edit' ,[ 'formulationType' => $formulationType->id ])
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
    public function destroy(FormulationType $formulationType)
    {
  
        $destroy = $formulationType->delete();
      

        if ($destroy)
        {
          //  dd($destroy);
              return redirect()
                              ->route('formulationType.index')
                              ->with('sucess', 'A variedade '. $formulationType->name . ' foi deletada com sucesso');
                      
  
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
