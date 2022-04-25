<?php

namespace App\Http\Controllers\Auxiliaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Auxiliaries\ChemicalGroup;

class ChemicalGroupController extends Controller
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

   $chemicalGroups = auth()->user()->chemicalGroup()->get();
  
        return view('auxiliaries.chemicalGroup.index', ['chemicalGroups' => $chemicalGroups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $chemicalGroup= new \App\Models\Auxiliaries\ChemicalGroup ([


        ]);

        return view('auxiliaries.chemicalGroup.create',compact('chemicalGroup'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ChemicalGroup  $chemicalGroup)
    {
        if ($request['note'] == null){
            $request['note'] = ".";
         }

         if ($request['description'] == null){
            $request['description'] = ".";
         }

        $data = $this->validateRequest();

     
        $chemicalGroup= new chemicalGroup();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $chemicalGroup->storechemicalGroup($data);

        if ($response)

        return redirect()
                        ->route('chemicalGroup.create')
                        ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar do Grupo Químico');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(chemicalGroup$chemicalGroup)
    {

        return view('auxiliaries.chemicalGroup.show', compact('chemicalGroup' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(chemicalGroup$chemicalGroup) {


        $user = auth()->user();


        return view('auxiliaries.chemicalGroup.edit',['chemicalGroup' => $chemicalGroup]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChemicalGroup  $chemicalGroup)
    {

       $dataRequest = $request; 

   
    $data['name']           = $dataRequest['name'];
    $data['description']    = $dataRequest['description'];
    $data['note']           = $dataRequest['note'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $chemicalGroup-> update($data);

      if ($update){

        return redirect()
                        ->route('chemicalGroup.edit' ,[ 'chemicalGroup' => $chemicalGroup->id ])
                        ->with('sucess', 'Sucesso ao atualizar');
      }     
    
        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização do Grupo Químico');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChemicalGroup  $chemicalGroup)
    {
  
        $destroy = $chemicalGroup->delete();
      

        if ($destroy)
        {
          //  dd($destroy);
              return redirect()
                              ->route('chemicalGroup.index')
                              ->with('sucess', 'Grupo Químico '. $chemicalGroup->name . ' foi deletada com sucesso');
                      
  
              return redirect()
                      ->back()
                      ->with('error',  'Falha na deleção do Grupo Químico');
  
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
