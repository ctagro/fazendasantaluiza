<?php

namespace App\Http\Controllers\Pesticide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\User;
Use App\Models\ActivePrinciple;
Use App\Models\Pesticide;
Use App\Models\ActivePrinciple_pesticide;
use App\Models\Auxiliaries\AgronomicClass;
use Redirect;

class ActivePrincipleController extends Controller
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
          $activePrinciples = ActivePrinciple::all();
          $agronomicClasses = AgronomicClass::all();
        return view('plantetc.activePrinciple.index', ['activePrinciples' => $activePrinciples, 'agronomicClasses' => $agronomicClasses]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $agronomicClasses = AgronomicClass::all();
          $user = auth()->user();
          $agronomicClasses = AgronomicClass::all();
          $activePrinciple = new \App\Models\ActivePrinciple([
          ]);
          $pesticides = Pesticide::all();
          $count = count($pesticides);
        return view('plantetc.activePrinciple.create',compact('activePrinciple','pesticides','count', 'agronomicClasses')); //teste       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  //dd($request);
      // Preenchendo o campo note
      if ($request['note'] == null){
        $request['note'] = "...";
     }

      // Capturando os dados da Diseases sem as activePrinciples relacionadas   
        $data = $this->validateRequest(); 
        $data['user_id'] = auth()->user()->id;
      
      //  Verificar se a cultura em referencia ja fui cadastrada

        $activePrinciple_entry = ActivePrinciple::where('name', '=', $data['name'])->get()->count();
        if($activePrinciple_entry > 0){     
            return redirect()
            ->route('activePrinciple.create')
            ->with('error',  'O princípio ativo '. $data['name'].' ja foi cadastrado');
        }
       // Gravando os dados da disease sem as disease relacionadas
       $activePrinciple = new activePrinciple();
       $response = $activePrinciple->storeActivePrinciple($data);
     //  dd($response['new_ActivePrinciple']);
       $activePrinciple_id = $response['new_ActivePrinciple'];
       $activePrinciple = ActivePrinciple::find($activePrinciple_id);

     // Capturando os dados das crops relacionadas 
       $pesticides= $request;
 
     // Testando se não houve pesticide relacionada      
       if($pesticides['pesticide_id'] != null)
       {
       // transformando os dados das pesticides relacionada em Array
           $pesticides_id = array_keys($pesticides['pesticide_id']);
        //   dd($pesticides_id);
       // Gravando a relação no arquivo intermediarios pesticide_activePrinciple
           foreach($pesticides_id as $pesticide_id)
               {    
                   $activePrinciple->pesticides()->attach($pesticide_id); //==>mudar
               }
       }
     // verificando se o regidtro no BD foi bem sucedido  
      if ($response)
      {
         return redirect()
                            ->route('activePrinciple.create')
                            ->with('sucess', 'Cadastro de '. $activePrinciple->name . ' realizado com sucesso');
        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar a cultura');
        }   
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ActivePrinciple_id)
    {
          $agronomicClasses = AgronomicClass::all();
          $activePrinciple = ActivePrinciple::find($ActivePrinciple_id);
          $user = auth()->user();
          $activePrinciple_name = $activePrinciple->name;
          $count = count($activePrinciple->pesticides);
          $pesticides = $activePrinciple->pesticides;

        return view('plantetc.activePrinciple.show', compact('activePrinciple','pesticides', 'agronomicClasses' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(activePrinciple $activePrinciple) {

        $user = auth()->user();
        $agronomicClasses = AgronomicClass::all();
// Para listar todas as crop com os dados completos
$relation_ids = Pesticide::all(); // =======> trocar
// para listar as disease relacionadas à cultura com todos os dados
      $relation_lists = $activePrinciple->pesticides; // =======> trocar
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


        return view('plantetc.activePrinciple.edit',compact('activePrinciple','relation_ids','relation_lists','agronomicClasses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, activePrinciple $activePrinciple)
    {
      // Update do campos do registro
      $request['user_id'] = auth()->user()->id;

      if ($request['note'] == null){$request['note'] = "...";}

      $dataRequest = $this->validateRequest();

      $data['user_id']          = $activePrinciple['user_id'];
      $data['name']             = $dataRequest['name'];
      $data['agronomicClass_id']= $dataRequest['agronomicClass_id'];
      $data['description']      = $dataRequest['description'];
      $data['in_use']           = $dataRequest['in_use'];  
      $data['note']             = $dataRequest['note'];

      // Gravar a atualizacões
      $update = $activePrinciple->update($data);
 
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
                  $activePrinciple->pesticides()->detach($before_id);} // =======> trocar     
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
                  {  $activePrinciple->pesticides()->attach($after_id);} // =======> trocar         
            }
          }
      //-----------------  Fim de Atualizar Relacionamentos --------------------//
     
        if ($update)
        return redirect()
                        ->route('activePrinciple.show' ,[ 'activePrinciple' => $activePrinciple->id ])
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
    public function destroy(ActivePrinciple $activePrinciple)
    {
      $activePrinciple_name  = $activePrinciple->name;      
      $destroy = $activePrinciple->delete();
         
      if ($destroy)
      {
           return redirect()
                            ->route('activePrinciple.index')
                            ->with('sucess', 'A cultura '. $activePrinciple_name . ' foi deletada com sucesso');
            return redirect()
                    ->back()
                    ->with('error',  'Falha na deleção a cultura');
        }
    }

    private function validateRequest()
    {

        return request()->validate([

            'user_id'               => 'required',
            'name'                  => 'required',
            'agronomicClass_id'     => 'required',
            'description'           => 'required',
            'note'                  => 'required',
            'in_use'                => 'required',
    
       ]);

    }
}
