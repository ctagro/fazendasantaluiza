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
        $count = count($diseases);
       return view('plantetc.crop.create',compact('crop','diseases','count')); //teste      
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
            $diseases_id = array_keys($diseases['disease_id']);
        // Gravando a relação no arquivo intermediarios crop_disease
            foreach($diseases_id as $disease_id)
                {
                    $crop->diseases()->attach($disease_id);
                }
        }
      // verificando se o regidtro no BD foi bem sucedido       
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
        $relation_ids = Disease::all(); // =======> trocar
  // para listar as disease relacionadas à cultura com todos os dados
        $relation_lists = $crop->diseases; // =======> trocar
   // Criando o array $index com a diseases relacionadas
        $index = [];
        $i=0;
        foreach($relation_lists as $relation_list){ 
            $index[$i] = $relation_list->id;
            $i++;}    
    // criando o array vazio para receber todas as diseases relacionada 
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
 
        return view('plantetc.crop.edit',compact('crop','relation_ids','relation_lists'));
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
          $befores_id = array_keys($list_ids['before_id']); 
          // Eliminar os relacionamentos antigos     
          foreach($befores_id as $before_id){
            $crop->diseases()->detach($before_id);} // =======> trocar     
        }
      //Passo 2 : Ler os relacionamentos atualizados
      // Verificar se houve solicitacao de limpar todos relacionamentos
      if($list_ids['clear_id'] == Null AND $list_ids['after_id'] != null) 
      {
         //  Criar um array dos relacionamentos
          $afters_id = array_keys($list_ids['after_id']); 
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

     //   dd($destroy);
        
  
     //   return redirect('crop.index');
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
