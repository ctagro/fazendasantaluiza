<?php

namespace App\Http\Controllers\Auxiliaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Auxiliaries\ActuationMechanism;

class ActuationMechanismController extends Controller
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

   $actuationMechanisms = ActuationMechanism::get();
  
        return view('auxiliaries.actuationMechanism.index', ['actuationMechanisms' => $actuationMechanisms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $actuationMechanism= new \App\Models\Auxiliaries\ActuationMechanism ([


        ]);

        return view('auxiliaries.actuationMechanism.create',compact('actuationMechanism'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ActuationMechanism  $actuationMechanism)
    {
        if ($request['note'] == null){
            $request['note'] = ".";
         }

         if ($request['description'] == null){
            $request['description'] = ".";
         }

        $data = $this->validateRequest();

     
        $actuationMechanism= new actuationMechanism();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $actuationMechanism->storeactuationMechanism($data);

        if ($response)

        return redirect()
                        ->route('actuationMechanism.create')
                        ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar do Mecanismo de Atuação');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(actuationMechanism$actuationMechanism)
    {

        return view('auxiliaries.actuationMechanism.show', compact('actuationMechanism' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(actuationMechanism$actuationMechanism) {


        $user = auth()->user();


        return view('auxiliaries.actuationMechanism.edit',['actuationMechanism' => $actuationMechanism]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActuationMechanism  $actuationMechanism)
    {

       $dataRequest = $request; 

   
    $data['name']           = $dataRequest['name'];
    $data['description']    = $dataRequest['description'];
    $data['note']           = $dataRequest['note'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $actuationMechanism-> update($data);

      if ($update){

        return redirect()
                        ->route('actuationMechanism.edit' ,[ 'actuationMechanism' => $actuationMechanism->id ])
                        ->with('sucess', 'Sucesso ao atualizar');
      }     
    
        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização do Mecanismo de Atuação');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActuationMechanism  $actuationMechanism)
    {
  
        $destroy = $actuationMechanism->delete();
      

        if ($destroy)
        {
          //  dd($destroy);
              return redirect()
                              ->route('actuationMechanism.index')
                              ->with('sucess', 'Mecanismo de Atuação '. $actuationMechanism->name . ' foi deletada com sucesso');
                      
  
              return redirect()
                      ->back()
                      ->with('error',  'Falha na deleção do Mecanismo de Atuação');
  
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
