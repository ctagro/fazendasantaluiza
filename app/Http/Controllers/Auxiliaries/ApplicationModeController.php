<?php

namespace App\Http\Controllers\Auxiliaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Auxiliaries\ApplicationMode;

class ApplicationModeController extends Controller
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

   $applicationModes = ApplicationMode::get();
  
        return view('auxiliaries.applicationMode.index', ['applicationModes' => $applicationModes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $applicationMode= new \App\Models\Auxiliaries\ApplicationMode ([


        ]);

        return view('auxiliaries.applicationMode.create',compact('applicationMode'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ApplicationMode  $applicationMode)
    {
        if ($request['note'] == null){
            $request['note'] = ".";
         }

         if ($request['description'] == null){
            $request['description'] = ".";
         }

        $data = $this->validateRequest();

     
        $applicationMode= new applicationMode();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $applicationMode->storeapplicationMode($data);

        if ($response)

        return redirect()
                        ->route('applicationMode.create')
                        ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar o mode de aplicação');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(applicationMode$applicationMode)
    {

        return view('auxiliaries.applicationMode.show', compact('applicationMode' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(applicationMode$applicationMode) {


        $user = auth()->user();


        return view('auxiliaries.applicationMode.edit',['applicationMode' => $applicationMode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApplicationMode  $applicationMode)
    {

       $dataRequest = $request; 

   
    $data['name']           = $dataRequest['name'];
    $data['description']    = $dataRequest['description'];
    $data['note']           = $dataRequest['note'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $applicationMode-> update($data);

      if ($update){

        return redirect()
                        ->route('applicationMode.edit' ,[ 'applicationMode' => $applicationMode->id ])
                        ->with('sucess', 'Sucesso ao atualizar');
      }     
    
        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização do modo de aplicação');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplicationMode  $applicationMode)
    {
  
        $destroy = $applicationMode->delete();
      

        if ($destroy)
        {
          //  dd($destroy);
              return redirect()
                              ->route('applicationMode.index')
                              ->with('sucess', 'o Modo de aplicação '. $applicationMode->name . ' foi deletado com sucesso');
                      
  
              return redirect()
                      ->back()
                      ->with('error',  'Falha na deleção do modo de aplicação');
  
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
