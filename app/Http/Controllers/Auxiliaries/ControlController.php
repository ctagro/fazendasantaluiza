<?php

namespace App\Http\Controllers\Auxiliaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Auxiliaries\Control;

class ControlController extends Controller
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

   $controles = Control::get();
  
        return view('auxiliaries.control.index', ['controles' => $controles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $control= new \App\Models\Auxiliaries\Control ([


        ]);

        return view('auxiliaries.control.create',compact('control'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Control  $control)
    {
        if ($request['note'] == null){
            $request['note'] = ".";
         }

         if ($request['description'] == null){
            $request['description'] = ".";
         }

        $data = $this->validateRequest();

     
        $control= new control();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $control->storecontrol($data);

        if ($response)

        return redirect()
                        ->route('control.create')
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
    public function show(control$control)
    {

        return view('auxiliaries.control.show', compact('control' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(control$control) {


        $user = auth()->user();


        return view('auxiliaries.control.edit',['control' => $control]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Control  $control)
    {

       $dataRequest = $request; 

   
    $data['name']           = $dataRequest['name'];
    $data['description']    = $dataRequest['description'];
    $data['note']           = $dataRequest['note'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $control-> update($data);

      if ($update){

        return redirect()
                        ->route('control.edit' ,[ 'control' => $control->id ])
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
    public function destroy(Control  $control)
    {
  
        $destroy = $control->delete();
      

        if ($destroy)
        {
          //  dd($destroy);
              return redirect()
                              ->route('control.index')
                              ->with('sucess', 'A variedade '. $control->name . ' foi deletada com sucesso');
                      
  
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
