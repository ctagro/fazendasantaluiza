<?php

namespace App\Http\Controllers\Auxiliaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Auxiliaries\Grupo_quimico;

class Grupo_quimicoController extends Controller
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

   $grupo_quimicos = Grupo_quimico::get();
  
        return view('auxiliaries.grupo_quimico.index', ['grupo_quimicos' => $grupo_quimicos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $grupo_quimico = new \App\Models\Auxiliaries\Grupo_quimico([


        ]);

        return view('auxiliaries.grupo_quimico.create',compact('grupo_quimico'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Grupo_quimico $grupo_quimico)
    {
        if ($request['note'] == null){
            $request['note'] = ".";
         }

         if ($request['description'] == null){
            $request['description'] = ".";
         }

        $data = $this->validateRequest();

     
        $grupo_quimico = new grupo_quimico();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $grupo_quimico->storegrupo_quimico($data);

        if ($response)

        return redirect()
                        ->route('grupo_quimico.create')
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
    public function show(grupo_quimico $grupo_quimico)
    {

        return view('auxiliaries.grupo_quimico.show', compact('grupo_quimico' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(grupo_quimico $grupo_quimico) {


        $user = auth()->user();


        return view('auxiliaries.grupo_quimico.edit',['grupo_quimico' => $grupo_quimico]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupo_quimico $grupo_quimico)
    {

       $dataRequest = $request; 

   
    $data['name']           = $dataRequest['name'];
    $data['description']    = $dataRequest['description'];
    $data['note']           = $dataRequest['note'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $grupo_quimico -> update($data);

      if ($update){

        return redirect()
                        ->route('grupo_quimico.edit' ,[ 'grupo_quimico' => $grupo_quimico->id ])
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
    public function destroy(Grupo_quimico $grupo_quimico)
    {
  
        $destroy = $grupo_quimico->delete();
      

        if ($destroy)
        {
          //  dd($destroy);
              return redirect()
                              ->route('grupo_quimico.index')
                              ->with('sucess', 'A variedade '. $grupo_quimico->name . ' foi deletada com sucesso');
                      
  
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
