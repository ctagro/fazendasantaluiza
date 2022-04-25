<?php

namespace App\Http\Controllers\Auxiliaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Auxiliaries\ModeOperation;

class ModeOperationController extends Controller
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

   $modeOperations = auth()->user()->modeOperation()->get();
  
        return view('auxiliaries.modeOperation.index', ['modeOperations' => $modeOperations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $modeOperation= new \App\Models\Auxiliaries\ModeOperation ([


        ]);

        return view('auxiliaries.modeOperation.create',compact('modeOperation'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ModeOperation  $modeOperation)
    {
        if ($request['note'] == null){
            $request['note'] = ".";
         }

         if ($request['description'] == null){
            $request['description'] = ".";
         }

        $data = $this->validateRequest();

     
        $modeOperation= new modeOperation();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $modeOperation->storemodeOperation($data);

        if ($response)

        return redirect()
                        ->route('modeOperation.create')
                        ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar do Modo de Atuação');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(modeOperation$modeOperation)
    {

        return view('auxiliaries.modeOperation.show', compact('modeOperation' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(modeOperation$modeOperation) {


        $user = auth()->user();


        return view('auxiliaries.modeOperation.edit',['modeOperation' => $modeOperation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModeOperation  $modeOperation)
    {

       $dataRequest = $request; 

   
    $data['name']           = $dataRequest['name'];
    $data['description']    = $dataRequest['description'];
    $data['note']           = $dataRequest['note'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $modeOperation-> update($data);

      if ($update){

        return redirect()
                        ->route('modeOperation.edit' ,[ 'modeOperation' => $modeOperation->id ])
                        ->with('sucess', 'Sucesso ao atualizar');
      }     
    
        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização do Modo de Atuação');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModeOperation  $modeOperation)
    {
  
        $destroy = $modeOperation->delete();
      

        if ($destroy)
        {
          //  dd($destroy);
              return redirect()
                              ->route('modeOperation.index')
                              ->with('sucess', 'O Modo de Atuação '. $modeOperation->name . ' foi deletada com sucesso');
                      
  
              return redirect()
                      ->back()
                      ->with('error',  'Falha na deleção do Modo de Atuação ');
  
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
