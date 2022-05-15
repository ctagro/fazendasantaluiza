<?php

namespace App\Http\Controllers\Pesticide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\User; 
Use App\Models\Crop;
Use App\Models\Disease;
Use App\Models\Crop_disease;
use Database\Seeders\DiseaseSeeder;
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
        $crops = Crop::all();
        $count = count($crops);
      return view('plantetc.disease.create',compact('disease','crops','count')); //teste       
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

        // Gravando os dados da disease sem as disease relacionadas
        $disease = new disease();
        $response = $disease->storeDisease($data);
        $disease_id = $response['new_disease'];
        $disease = Disease::find($disease_id);

      // Capturando os dados das crops relacionadas 
        $crops= $request;
  
      // Testando se não houve crop relacionada      
        if($crops['crop_id'] != null)
        {
        // transformando os dados das crops relacionada em Array
            $crops_id = array_keys($crops['crop_id']);
         //   dd($crops_id);
        // Gravando a relação no arquivo intermediarios crop_disease
            foreach($crops_id as $crop_id)
                {    
                    $disease->crops()->attach($crop_id); //==>mudar
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
          $disease = Disease::find($disease_id);
          $user = auth()->user();
          $disease_name = $disease->name;
          $count = count($disease->crops);
          $crops = $disease->crops;

        return view('plantetc.disease.show', compact('crops','disease' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Disease $disease) {


        $user = auth()->user();

 // Para listar todas as crop com os dados completos
 $relation_ids = Crop::all(); // =======> trocar
 // para listar as disease relacionadas à cultura com todos os dados
       $relation_lists = $disease->crops; // =======> trocar
  // Criando o array $index com a crops relacionadas
       $index = [];
       $i=0;
       foreach($relation_lists as $relation_list){ 
           $index[$i] = $relation_list->id;
           $i++;}    
   // criando o array vazio para receber todas as crops relacionada 
   // e preparar para marca-las os indices sem relação co null na view
       $relation_lists_result = [];
       $count = count($relation_ids);
       $j = 0;
       $count_j = count($index);
       $names = [];
       $relation_id =[];
   // Populando o arry resultante com todas as doenças e setando as relacionadas
       for ($i = 1; $i < $count+1; $i++){
         if($count_j>0){
               if(($i+1) == ($index[$j]+1) ){
                 $relation_lists_result[$i] = ($relation_lists[$j]->id);
                 $j++;
                   if($j >= $count_j){
                     $j = $j-1;}}
               else{$relation_lists_result[$i] = Null;}
           }
           else{$relation_lists_result[$i] = Null; }
       }
       $relation_lists = $relation_lists_result;

        return view('plantetc.disease.edit',compact('disease','relation_ids','relation_lists'));
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
       $data['control']         = $dataRequest['control'];
       $data['in_use']         = $dataRequest['in_use'];  
       $data['note']           = $dataRequest['note'];

 // Gravar a atualizacões
       $update = $disease->update($data);
 
 //-----------------  Atualizar Relacionamentos Crop->Diseases----------------//
       $list_ids = $request; 
   //  Passo1 : Apagar os registros antigo das relações com as doenças
   // Verificar se houve atualizaçao de relacionamentos 
     if($list_ids['after_id']!= Null OR $list_ids['clear_id'] != Null){     
       // Verificar se tem relacionamentos antigos ou se quer limpar todos
         if($list_ids['before_id'] != Null OR $list_ids['clear_id'] != Null) 
         {//  Criar um array dos relacionamentos antigos
           $befores_id = array_keys($list_ids['before_id']); 
           // Eliminar os relacionamentos antigos     
           foreach($befores_id as $before_id){
             $disease->crops()->detach($before_id);} // =======> trocar     
         }
       //Passo 2 : Ler os relacionamentos atualizados
       // Verificar se houve solicitacao de limpar todos relacionamentos
       if($list_ids['clear_id'] == Null AND $list_ids['after_id'] != null) 
       {
          //  Criar um array dos relacionamentos
           $afters_id = array_keys($list_ids['after_id']); 
      //     dd($request,$afters_id,$disease);
         // Gravar a atualizacao dos relacionamentos  
           foreach($afters_id as $after_id)
             {  $disease->crops()->attach($after_id);} // =======> trocar         
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
            'control'         => 'required',
            'note'            => 'required',
            'in_use'          => 'required',
    
       ]);

    }
}
