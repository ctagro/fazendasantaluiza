<?php

namespace App\Http\Controllers\Auxiliaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Auxiliaries\Manufacturer;

class ManufacturerController extends Controller
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

   $manufactureres = Manufacturer::get();
  
        return view('auxiliaries.manufacturer.index', ['manufactureres' => $manufactureres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $manufacturer= new \App\Models\Auxiliaries\Manufacturer ([


        ]);

        return view('auxiliaries.manufacturer.create',compact('manufacturer'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Manufacturer  $manufacturer)
    {
        if ($request['note'] == null){
            $request['note'] = ".";
         }

         if ($request['description'] == null){
            $request['description'] = ".";
         }

        $data = $this->validateRequest();

     
        $manufacturer= new manufacturer();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $manufacturer->storemanufacturer($data);

        if ($response)

        return redirect()
                        ->route('manufacturer.create')
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
    public function show(manufacturer$manufacturer)
    {

        return view('auxiliaries.manufacturer.show', compact('manufacturer' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(manufacturer$manufacturer) {


        $user = auth()->user();


        return view('auxiliaries.manufacturer.edit',['manufacturer' => $manufacturer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufacturer  $manufacturer)
    {

       $dataRequest = $request; 

   
    $data['name']           = $dataRequest['name'];
    $data['description']    = $dataRequest['description'];
    $data['note']           = $dataRequest['note'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $manufacturer-> update($data);

      if ($update){

        return redirect()
                        ->route('manufacturer.edit' ,[ 'manufacturer' => $manufacturer->id ])
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
    public function destroy(Manufacturer  $manufacturer)
    {
  
        $destroy = $manufacturer->delete();
      

        if ($destroy)
        {
          //  dd($destroy);
              return redirect()
                              ->route('manufacturer.index')
                              ->with('sucess', 'A variedade '. $manufacturer->name . ' foi deletada com sucesso');
                      
  
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
