<?php

namespace App\Http\Controllers;

use App\Models\Auxiliaries\Crop_variety;
use Illuminate\Http\Request;

use DB;
use App\Models\User;
Use App\Models\Crop;
Use App\Models\Disease;
Use App\Models\Crop_disease;
use phpDocumentor\Reflection\Types\Null_;
use Redirect;



class CropController extends Controller
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

        $crops = Crop::all();
        return view('plantetc.crop.index', ['crops' => $crops]);
    }

    public function variety($crop_id)
    {
      $crop = Crop::find($crop_id);
      $crop_varieties = Crop_variety::where('crop_id', '=', $crop_id)->get();

      return view('auxiliaries.crop_variety.index', ['crop_varieties' => $crop_varieties, 'crop' => $crop]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $user = auth()->user();
          $crop = new \App\Models\Crop([
          ]);
          $diseases = Disease::all();

       return view('plantetc.crop.create',compact('crop','diseases')); //teste      
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

      // Capturando os dados da Crops sem as diseases relacionadas   
        $data = $this->validateRequest(); 
        $data['user_id'] = auth()->user()->id;
      
      //  Verificar se a cultura em referencia ja fui cadastrada

        $crop_entry = Crop::where('name', '=', $data['name'])->get()->count();
        if($crop_entry > 0){
            return redirect()
            ->route('crop.create')
            ->with('error',  'A cultura '. $data['name'].' ja foi cadastrada');
        }

        // Gravando os dados da crop sem as disease relacionadas
        $crop = new crop();
        $response = $crop->storeCrop($data);
        $crop_id = $response['new_crop'];
        $crop = Crop::find($crop_id);

      // Capturando os dados das diseases relacionadas 
        $diseases= $request;
      // Testando se não houve disease relacionada        
        if($diseases['disease_id'] != null)
        {
        // transformando os dados das diseases relacionada em Array
            $diseases_id = array($diseases['disease_id']);

        // Gravando a relação no arquivo intermediarios crop_disease
            foreach($diseases_id as $disease_id)
                {
                    $crop->diseases()->attach($disease_id);
                }
        }
      // verificando se o registro no BD foi bem sucedido       
      if ($response)
      {
        return redirect()
                    ->route('crop.create')
                    ->with('sucess', 'Cadastro de '. $crop->name . ' realizado com sucesso');                           
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
    public function show($crop_id)
    {   
          $crop = Crop::find($crop_id);
          $user = auth()->user();
          $crop_name = $crop->name;
          $count = count($crop->diseases);
          $diseases = $crop->diseases;

        return view('plantetc.crop.show', compact('crop','diseases' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Crop $crop) {

        $user = auth()->user();

  // Para listar todas as disease com os dados completos
        $relation0_ids = Disease::all(); // =======> trocar
  // para listar as disease relacionadas à cultura com todos os dados
        $relation0_lists = $crop->diseases; // =======> trocar

        $i = 0;
        $temp = [];
  // Criando o array com todos os pesticides
        foreach($relation0_ids as $relation0_id){ 
          $i++;
          $relation_ids[$i] = $relation0_id->id;
          $temp[$i] = null;
        }
   
   // Criando o array com os pesticides relacionadas
        $relation_lists =[];
        $i= 0;
        foreach($relation0_lists as $relation0_list){ 
          $index[$i] = $relation0_list->id;
          $i++; 
          $relation_lists[$i] = $relation0_list->id;
            } 
  
  // testando se nao tem pesticides relacionados
          if(empty($relation_lists)){       
              $count_i  = count($relation_ids);
                for ($i = 1; $i <= $count_i; $i++){
                  $relation_lists[$i] = null;
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
  
   //    dd($relation_ids,$relation_lists,$relation0_ids);
 
        return view('plantetc.crop.edit',compact('crop','relation_ids','relation_lists','relation0_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crop $crop)
    {
  
    // Update do campos do registro
     $request['user_id'] = auth()->user()->id;

     if ($request['note'] == null){$request['note'] = "...";}

      $dataRequest = $this->validateRequest();

      $data['user_id']        = $dataRequest['user_id'];
      $data['name']           = $dataRequest['name'];
      $data['scientific_name']= $dataRequest['scientific_name'];
      $data['description']    = $dataRequest['description'];
      $data['in_use']         = $dataRequest['in_use'];  
      $data['note']           = $dataRequest['note'];
// Gravar a atualizacões
      $update = $crop->update($data);

//-----------------  Atualizar Relacionamentos Crop->Diseases----------------//
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
            $crop->diseases()->detach($before_id);} // =======> trocar     
        }
      //Passo 2 : Ler os relacionamentos atualizados
      // Verificar se houve solicitacao de limpar todos relacionamentos
      if($list_ids['clear_id'] == Null AND $list_ids['after_id'] != null) 
      {
         //  Criar um array dos relacionamentos
          $afters_id = array($list_ids['after_id']); 
        // Gravar a atualizacao dos relacionamentos  
          foreach($afters_id as $after_id)
            {  $crop->diseases()->attach($after_id);} // =======> trocar         
      }
    }
//-----------------  Fim de Atualizar Relacionamentos --------------------//

        if ($update)
        return redirect()
                        ->route('crop.show' ,[ 'crop' => $crop->id ])
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
    public function destroy(Crop $crop)
    {
      
      $crop_name  = $crop->name;      
      $destroy = $crop->delete();
     
      if ($destroy)
      {
            return redirect()
                            ->route('crop.index')
                            ->with('sucess', 'A cultura '. $crop_name . ' foi deletada com sucesso');
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
            'note'            => 'required',
            'in_use'          => 'required',
    
       ]);

    }
}
