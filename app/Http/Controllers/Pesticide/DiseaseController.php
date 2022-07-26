<?php

namespace App\Http\Controllers\Pesticide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\User; 
use App\Models\ActivePrinciple;
Use App\Models\Disease;
use App\Models\Auxiliaries\Control;
use Redirect;

class DiseaseController extends Controller
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
          $diseases = Disease::all();
        return view('plantetc.disease.index', ['diseases' => $diseases]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $disease= new \App\Models\Disease([ 
        ]);
        $active_principles = ActivePrinciple::all();
        $controls = Control::all();
        $count = count($active_principles);
      return view('plantetc.disease.create',compact('disease','active_principles','controls','count')); //teste       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      // Preenchendo o campo note
      if ($request['note'] == null){
        $request['note'] = "...";
     }

      // Capturando os dados da Diseases sem as diseases relacionadas   
        $data = $this->validateRequest(); 
        $data['user_id'] = auth()->user()->id;
      
      //  Verificar se a cultura em referencia ja fui cadastrada

        $disease_entry = Disease::where('name', '=', $data['name'])->get()->count();
        if($disease_entry > 0){
            return redirect()
            ->route('disease.create')
            ->with('error',  'A Praga / Doença '. $data['name'].' ja foi cadastrada');
        }

        // Gravando os dados da disease sem as active_principle relacionadas
        $disease = new disease();
        $response = $disease->storeDisease($data);
        $disease_id = $response['new_disease'];
        $disease = Disease::find($disease_id);

      // Capturando os dados das active_principles relacionadas 
        $active_principles= $request;
 
      // Testando se não houve active_principle relacionada      
        if($active_principles['active_principle_id'] != null)
        {
        // transformando os dados das active_principles relacionada em Array
            $active_principles_id = array($active_principles['active_principle_id']);
        
        // Gravando a relação no arquivo intermediarios active_principle_disease
            foreach($active_principles_id as $active_principle_id)
                {    
                    $disease->active_principles()->attach($active_principle_id); //==>mudar
                }
        }
      // verificando se o regidtro no BD foi bem sucedido  
      if ($response)
      {
            return redirect()
                            ->route('disease.create')
                            ->with('sucess', 'Cadastro de '. $disease->name . ' realizado com sucesso');
            return redirect()
                        ->back()
                        ->with('error',  'Falha ao cadastrar a doença');
        }
    
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($disease_id)
    {

          $controls = Control::all();
          $disease = Disease::find($disease_id);
          $user = auth()->user();
        //  dd($disease);
          $disease_name = $disease->name;
          $count = count($disease->active_principles);
          $active_principles = $disease->active_principles;

        return view('plantetc.disease.show', compact('active_principles','disease','controls' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Disease $disease) {


        $controls = Control::all();
        $user = auth()->user();
        $disease_id = $disease->id;

 // Para listar todas as active_principle com os dados completos
      $relation0_ids = ActivePrinciple::all(); // =======> trocar


 // para listar as disease relacionadas à cultura com todos os dados
       $relation0_lists = $disease->active_principles; // =======> trocar


       $i = 0;
      $temp = [];
// Criando o array com todos as diseases
      foreach($relation0_ids as $relation0_id){ 
        $i++;
        $relation_ids[$i] = $relation0_id->id;
        $temp[$i] = 9999;
      }
 
 // Criando o array com as diseases relacionadas
      $relation_lists =[];
      $i= 0;
      foreach($relation0_lists as $relation0_list){ 
        $index[$i] = $relation0_list->id;
        $i++; 
        $relation_lists[$i] = $relation0_list->id;
          } 

// testando se nao tem diseases relacionados
        if(empty($relation_lists)){       
            $count_i  = count($relation_ids);
              for ($i = 1; $i <= $count_i; $i++){
                $relation_lists[$i] = 9999;
              }  
            }
          else{
            $count_i  = count($relation_lists); 
        }
          $count_j = count($relation_ids);

          for ($j = 1; $j <= $count_j; $j++){
            for ($i = 1; $i <= $count_i; $i++){
              if($relation_ids[$j] == $relation_lists[$i] ){
                $temp[$j] = $relation_lists[$i];
                break;
              }
            }
          }
 
        $relation_lists = $temp;

  //   dd($relation_ids,$relation_lists,$relation0_ids);


        return view('plantetc.disease.edit',compact('disease','relation_ids','relation_lists','relation0_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disease $disease)
    {
      // Update do campos do registro
      $request['user_id'] = auth()->user()->id;

      if ($request['note'] == null){$request['note'] = "...";}
 
       $dataRequest = $this->validateRequest();
 
       $data['user_id']        = $dataRequest['user_id'];
       $data['name']           = $dataRequest['name'];
       $data['scientific_name']= $dataRequest['scientific_name'];
       $data['description']    = $dataRequest['description'];
       $data['symptoms']       = $dataRequest['symptoms'];
       $data['control_id']     = $dataRequest['control'];
       $data['control']         = $dataRequest['control'];
       $data['in_use']         = $dataRequest['in_use'];  
       $data['note']           = $dataRequest['note'];

 // Gravar a atualizacões
       $update = $disease->update($data);
 
 //-----------------  Atualizar Relacionamentos ActivitePrinciple->Diseases----------------//
       $list_ids = $request; 
   //  Passo1 : Apagar os registros antigo das relações com as doenças
   // Verificar se houve atualizaçao de relacionamentos 
     if($list_ids['after_id']!= Null OR $list_ids['clear_id'] != Null){     
       // Verificar se tem relacionamentos antigos ou se quer limpar todos
         if($list_ids['before_id'] != Null OR $list_ids['clear_id'] != Null) 
         {//  Criar um array dos relacionamentos antigos
           $befores_id = array($list_ids['before_id']); 
           // Eliminar os relacionamentos antigos     
           foreach($befores_id as $before_id){
             $disease->active_principles()->detach($before_id);} // =======> trocar     
         }
       //Passo 2 : Ler os relacionamentos atualizados
       // Verificar se houve solicitacao de limpar todos relacionamentos
       if($list_ids['clear_id'] == Null AND $list_ids['after_id'] != null) 
       {
          //  Criar um array dos relacionamentos
           $afters_id = array($list_ids['after_id']); 
      //     dd($request,$afters_id,$disease);
         // Gravar a atualizacao dos relacionamentos  
           foreach($afters_id as $after_id)
             {  $disease->active_principles()->attach($after_id);} // =======> trocar         
       }
     }
 //-----------------  Fim de Atualizar Relacionamentos --------------------//

        if ($update)
        return redirect()
                        ->route('disease.show' ,[ 'disease' => $disease->id ])
                        ->with('sucess', 'Sucesso ao salvar alteração');
        return redirect()
                    ->back()
                    ->with('error',  'Falha ao salvar alteração');     
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disease $disease)
    {

      $disease_name  = $disease->name;    
      $destroy = $disease->delete();
           
      if ($destroy)
      {

            return redirect()
                            ->route('disease.index')
                            ->with('sucess', 'A doença '. $disease_name . ' foi deletada com sucesso');
                    
            return redirect()
                    ->back()
                    ->with('error',  'Falha na deleção a cultura');
        }
    }

    private function validateRequest()
    {

        return request()->validate([

            'user_id'         => 'required',
            'name'            => 'required',
            'scientific_name' => 'required',
            'description'     => 'required',
            'symptoms'        => 'required',
            'control_id'      => 'required',
            'control'         => 'required',
            'note'            => 'required',
            'in_use'          => 'required',
    
       ]);

    }
}
