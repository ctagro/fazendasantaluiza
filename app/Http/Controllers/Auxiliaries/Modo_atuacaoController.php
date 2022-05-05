<?php

namespace App\Http\Controllers\Auxiliaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Auxiliaries\Modo_atuacao;

class Modo_atuacaoController extends Controller
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

   $modo_atuacaos = Modo_atuacao::get();
  
        return view('auxiliaries.modo_atuacao.index', ['modo_atuacaos' => $modo_atuacaos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $modo_atuacao= new \App\Models\Auxiliaries\Modo_atuacao ([


        ]);

        return view('auxiliaries.modo_atuacao.create',compact('modo_atuacao'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Modo_atuacao  $modo_atuacao)
    {
        if ($request['note'] == null){
            $request['note'] = ".";
         }

         if ($request['description'] == null){
            $request['description'] = ".";
         }

        $data = $this->validateRequest();

     
        $modo_atuacao= new modo_atuacao();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $modo_atuacao->storemodo_atuacao($data);

        if ($response)

        return redirect()
                        ->route('modo_atuacao.create')
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
    public function show(modo_atuacao$modo_atuacao)
    {

        return view('auxiliaries.modo_atuacao.show', compact('modo_atuacao' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(modo_atuacao$modo_atuacao) {


        $user = auth()->user();


        return view('auxiliaries.modo_atuacao.edit',['modo_atuacao' => $modo_atuacao]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modo_atuacao  $modo_atuacao)
    {

       $dataRequest = $request; 

   
    $data['name']           = $dataRequest['name'];
    $data['description']    = $dataRequest['description'];
    $data['note']           = $dataRequest['note'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $modo_atuacao-> update($data);

      if ($update){

        return redirect()
                        ->route('modo_atuacao.edit' ,[ 'modo_atuacao' => $modo_atuacao->id ])
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
    public function destroy(Modo_atuacao  $modo_atuacao)
    {
  
        $destroy = $modo_atuacao->delete();
      

        if ($destroy)
        {
          //  dd($destroy);
              return redirect()
                              ->route('modo_atuacao.index')
                              ->with('sucess', 'A variedade '. $modo_atuacao->name . ' foi deletada com sucesso');
                      
  
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
