<?php

namespace App\Http\Controllers\Auxiliaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Auxiliaries\AgronomicClass;

class AgronomicClassController extends Controller
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

   $agronomicClasses = auth()->user()->agronomicClass()->get();
  
        return view('auxiliaries.agronomicClass.index', ['agronomicClasses' => $agronomicClasses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $agronomicClass = new \App\Models\Auxiliaries\AgronomicClass([


        ]);

        return view('auxiliaries.agronomicClass.create',compact('agronomicClass'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AgronomicClass $agronomicClass)
    {
        if ($request['note'] == null){
            $request['note'] = ".";
         }

         if ($request['description'] == null){
            $request['description'] = ".";
         }

        $data = $this->validateRequest();

     
        $agronomicClass = new agronomicClass();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $agronomicClass->storeagronomicClass($data);

        if ($response)

        return redirect()
                        ->route('agronomicClass.create')
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
    public function show(agronomicClass $agronomicClass)
    {

        return view('auxiliaries.agronomicClass.show', compact('agronomicClass' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(agronomicClass $agronomicClass) {


        $user = auth()->user();


        return view('auxiliaries.agronomicClass.edit',['agronomicClass' => $agronomicClass]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AgronomicClass $agronomicClass)
    {

       $dataRequest = $request; 

   
    $data['name']           = $dataRequest['name'];
    $data['description']    = $dataRequest['description'];
    $data['note']           = $dataRequest['note'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $agronomicClass -> update($data);

      if ($update){

        return redirect()
                        ->route('agronomicClass.edit' ,[ 'agronomicClass' => $agronomicClass->id ])
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
    public function destroy(AgronomicClass $agronomicClass)
    {
  
        $destroy = $agronomicClass->delete();
      

        if ($destroy)
        {
          //  dd($destroy);
              return redirect()
                              ->route('agronomicClass.index')
                              ->with('sucess', 'A variedade '. $agronomicClass->name . ' foi deletada com sucesso');
                      
  
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
