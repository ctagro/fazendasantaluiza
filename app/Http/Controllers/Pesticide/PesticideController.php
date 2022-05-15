<?php

namespace App\Http\Controllers\Pesticide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\User;
Use App\Models\Crop;
Use App\Models\Disease;
Use App\Models\Pesticide;
Use App\Models\ActivePrinciple;
Use App\Models\Crop_pesticise;
use App\Models\Auxiliaries\AgronomicClass;
use App\Models\Auxiliaries\FormulationType;
use App\Models\Auxiliaries\Manufacturer;
use App\Models\Auxiliaries\ApplicationMode;
use App\Models\Auxiliaries\ChemicalGroup;
use App\Models\Auxiliaries\ToxicologicalClass;
use App\Models\Auxiliaries\ActionSite;
use App\Models\Auxiliaries\ModeOperation;
use App\Models\Auxiliaries\ActuationMechanism;

use Redirect;

class PesticideController extends Controller
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

      $manufacturers = Manufacturer::all();
      $chemicalGroups = ChemicalGroup::all();
      $agronomicClasses = AgronomicClass::all();
      $chemicalGroups = ChemicalGroup::all();      
      $pesticides = Pesticide::get();
      $users = User::all();

          return view('plantetc.pesticide.index', compact('pesticides','manufacturers','chemicalGroups','agronomicClasses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $agronomicClasses         = AgronomicClass::all();
      $formulationTypes         = FormulationType::all();
      $manufacturers            = Manufacturer::all();
      $applicationModes         = ApplicationMode::all();
      $chemicalGroups           = ChemicalGroup::all();
      $toxicologicalClasses     = ToxicologicalClass::all();
      $actionSites              = ActionSite::all();
      $modeOperations           = ModeOperation::all();
      $actuationMechanisms      = ActuationMechanism::all();


        $user = auth()->user();
        $pesticide= new \App\Models\Pesticide([   
        ]);
        $crops = Crop::all();
        $count_crops = count($crops);
        $diseases = Disease::all();
        $count_diseases = count($crops);
        $active_principles = ActivePrinciple::all();
        $count_active_principles = count($crops);

       return view('plantetc.pesticide.create',compact('pesticide','crops','count_crops','diseases',
                                                        'count_diseases','active_principles','count_active_principles',
                                                        'agronomicClasses','formulationTypes','manufacturers',
                                                        'applicationModes','chemicalGroups','toxicologicalClasses',
                                                        'actionSites','modeOperations','actuationMechanisms')); 
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
      if ($request['note'] == null){
        $request['note'] = "...";
     }
      // Capturando os dados do Pesticides sem as diseases relacionadas
        $data = $this->validateRequest(); 
        $userName['user_id'] = auth()->user()->name;

   //  Verificar se a cultura em referencia ja fui cadastrada
   $pesticide_entry = Disease::where('name', '=', $data['name'])->get()->count();
   if($pesticide_entry > 0){
       return redirect()
       ->route('pesticide.create')
       ->with('error',  'O defensivo '. $data['name'].' ja foi cadastrada');
   }
    // Gravando os dados da pesticide sem as disease relacionadas
    $pesticide = new pesticide();
    $response = $pesticide->storePesticide($data);
    $pesticide_id = $response['new_pesticide'];
    $pesticide = Pesticide::find($pesticide_id);
  
        
              //============== Capturando os dados das crops relacionadas =========
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
                            $pesticide->crops()->attach($crop_id); //==>mudar
                        }
                }
       
             //============== Capturando os dados das diseases relacionadas =========
             $diseases= $request;
                
             // Testando se não houve disease relacionada      
               if($diseases['disease_id'] != null)
               {
               // transformando os dados das diseases relacionada em Array
                   $diseases_id = array_keys($diseases['disease_id']);
                 //   dd($diseases_id);
               // Gravando a relação no arquivo intermediarios disease_disease
                   foreach($diseases_id as $disease_id)
                       {    
                           $pesticide->diseases()->attach($disease_id); //==>mudar
                       }
               }

            //============== Capturando os dados das active_principles relacionadas =========
            $active_principles= $request;
                
            // Testando se não houve active_principle relacionada      
              if($active_principles['active_principle_id'] != null)
              {
              // transformando os dados das active_principles relacionada em Array
                  $active_principles_id = array_keys($active_principles['active_principle_id']);
                //   dd($active_principles_id);
              // Gravando a relação no arquivo intermediarios active_principle_disease
                  foreach($active_principles_id as $active_principle_id)
                      {    
                          $pesticide->active_principles()->attach($active_principle_id); //==>mudar
                      }
              }
 
              // verificando se o regidtro no BD foi bem sucedido  
                if ($response)
                {
                      return redirect()
                                      ->route('pesticide.create')
                                      ->with('sucess', 'Cadastro de '. $pesticide->name . ' realizado com sucesso');
                  return redirect()
                              ->back()
                              ->with('error',  'Falha ao cadastrar o defensivo');
                  }    
      }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pesticide_id)
    {

      $agronomicClasses         = AgronomicClass::all();
      $formulationTypes         = FormulationType::all();
      $manufacturers            = Manufacturer::all();
      $applicationModes         = ApplicationMode::all();
      $chemicalGroups           = ChemicalGroup::all();
      $toxicologicalClasses     = ToxicologicalClass::all();
      $actionSites              = ActionSite::all();
      $modeOperations           = ModeOperation::all();
      $actuationMechanisms      = ActuationMechanism::all();
      $active_principles        = ActivePrinciple::all();


        $pesticide = Pesticide::find($pesticide_id);
        
        $user = auth()->user();
        $pesticide_name = $pesticide->name;
        $crops = $pesticide->crops;

        $pesticide_name = $pesticide->name;
        $diseases = $pesticide->diseases;

        $pesticide_name = $pesticide->name;
        $active_principles = $pesticide->active_principles;

        return view('plantetc.pesticide.show', compact('pesticide', 'crops', 'diseases', 'active_principles' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesticide $pesticide) {

      $agronomicClasses         = AgronomicClass::all();
      $formulationTypes         = FormulationType::all();
      $manufacturers            = Manufacturer::all();
      $applicationModes         = ApplicationMode::all();
      $chemicalGroups           = ChemicalGroup::all();
      $toxicologicalClasses     = ToxicologicalClass::all();
      $actionSites              = ActionSite::all();
      $modeOperations           = ModeOperation::all();
      $actuationMechanisms      = ActuationMechanism::all();


        $user = auth()->user();

//============= Para listar todas as crop com os dados completos============

            $relationCrop_ids = Crop::all(); // =======> trocar
            // para listar as disease relacionadas à cultura com todos os dados
                  $relationCrop_lists = $pesticide->crops; // =======> trocar

            // Criando o array $index com a crops relacionadas
                  $indexCrop = [];
                  $i=0;
                  foreach($relationCrop_lists as $relationCrop_list){ 
                      $indexCrop[$i] = $relationCrop_list->id;
                      $i++;}    
              // criando o array vazio para receber todas as crops relacionada 
              // e preparar para marca-las os indices sem relação co null na view
                  $relationCrop_lists_result = [];
                  $countCrop = count($relationCrop_ids);
                  $j = 0;
                  $countCrop_j = count($indexCrop);
                  $names = [];
                  $relationCrop_id =[];
              // Populando o arry resultante com todas as doenças e setando as relacionadas
                  for ($i = 1; $i < $countCrop+1; $i++){
                    if($countCrop_j>0){
                          if(($i+1) == ($indexCrop[$j]+1) ){
                            $relationCrop_lists_result[$i] = ($relationCrop_lists[$j]->id);
                            $j++;
                              if($j >= $countCrop_j){
                                $j = $j-1;}}
                          else{$relationCrop_lists_result[$i] = Null;}
                      }
                      else{$relationCrop_lists_result[$i] = Null; }
                  }
                  $relationCrop_lists = $relationCrop_lists_result;

     
 //============= Para listar todas as Disease com os dados completos============

                $relationDisease_ids = Disease::all(); // =======> trocar
                // para listar as disease relacionadas à cultura com todos os dados
                      $relationDisease_lists = $pesticide->diseases; // =======> trocar
                // Criando o array $index com a crops relacionadas
                      $indexDisease = [];
                      $i=0;
                      foreach($relationDisease_lists as $relationDisease_list){ 
                          $indexDisease[$i] = $relationDisease_list->id;
                          $i++;}    
                  // criando o array vazio para receber todas as crops relacionada 
                  // e preparar para marca-las os indices sem relação co null na view
                      $relationDisease_lists_result = [];
                      $countDisease = count($relationDisease_ids);
                      $j = 0;
                      $countDisease_j = count($indexDisease);
                      $names = [];
                      $relationDisease_id =[];
                  // Populando o arry resultante com todas as doenças e setando as relacionadas
                      for ($i = 1; $i < $countDisease+1; $i++){
                        if($countDisease_j>0){
                              if(($i+1) == ($indexDisease[$j]+1) ){
                                $relationDisease_lists_result[$i] = ($relationDisease_lists[$j]->id);
                                $j++;
                                  if($j >= $countDisease_j){
                                    $j = $j-1;}}
                              else{$relationDisease_lists_result[$i] = Null;}
                          }
                          else{$relationDisease_lists_result[$i] = Null; }
                      }
                      $relationDisease_lists = $relationDisease_lists_result;


 //============= Para listar todas as Activite Principle com os dados completos============

 $relationActive_principle_ids = ActivePrinciple::all(); // =======> trocar
 // para listar as disease relacionadas à cultura com todos os dados
       $relationActive_principle_lists = $pesticide->active_principles; // =======> trocar
 // Criando o array $index com a crops relacionadas
       $indexActive_principle = [];
       $i=0;
       foreach($relationActive_principle_lists as $relationActive_principle_list){ 
           $indexActive_principle[$i] = $relationActive_principle_list->id;
           $i++;}    
   // criando o array vazio para receber todas as crops relacionada 
   // e preparar para marca-las os indices sem relação co null na view
       $relationActive_principle_lists_result = [];
       $countActive_principle = count($relationActive_principle_ids);
       $j = 0;
       $countActive_principle_j = count($indexActive_principle);
       $names = [];
       $relationActive_principle_id =[];
   // Populando o arry resultante com todas as doenças e setando as relacionadas
       for ($i = 1; $i < $countActive_principle+1; $i++){
         if($countActive_principle_j>0){
               if(($i+1) == ($indexActive_principle[$j]+1) ){
                 $relationActive_principle_lists_result[$i] = ($relationActive_principle_lists[$j]->id);
                 $j++;
                   if($j >= $countActive_principle_j){
                     $j = $j-1;}}
               else{$relationActive_principle_lists_result[$i] = Null;}
           }
           else{$relationActive_principle_lists_result[$i] = Null; }
       }
       $relationActive_principle_lists = $relationActive_principle_lists_result;

        
    //  dd($relationCrop_ids, $relationCrop_lists, $relationDisease_ids, $relationDisease_lists, $relationActive_principle_ids, $relationActive_principle_lists);

        return view('plantetc.pesticide.edit',compact('pesticide', 'relationCrop_ids','relationCrop_lists',
                                                      'relationDisease_ids','relationDisease_lists', 
                                                      'relationActive_principle_ids','relationActive_principle_lists',
                                                      'agronomicClasses','formulationTypes','manufacturers',
                                                      'applicationModes','chemicalGroups','toxicologicalClasses',
                                                      'actionSites','modeOperations','actuationMechanisms')); 
  }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesticide $pesticide)
    {
       // dd($request);
            // Update do campos do registro
            $request['user_id'] = auth()->user()->id;

            if ($request['note'] == null){$request['note'] = "...";}

            $dataRequest = $this->validateRequest();

            $data['user_id'] =  $dataRequest['user_id'];
            $data['name'] = $dataRequest['name'];
            $data['manufacturer_id'] = $dataRequest['manufacturer_id'];
            $data['agronomicClass_id'] = $dataRequest['agronomicClass_id'];
            $data['formulationType_id'] = $dataRequest['formulationType_id'];
            $data['dosage'] = $dataRequest['dosage'];
            $data['unity'] = $dataRequest['unity'];
            $data['applicationMode_id'] = $dataRequest['applicationMode_id'];
            $data['toxicologicalClass_id'] = $dataRequest['toxicologicalClass_id'];
            $data['chemicalGroup_id'] = $dataRequest['chemicalGroup_id'];
            $data['actionSite_id'] = $dataRequest['actionSite_id'];
            $data['modeOperation_id'] = $dataRequest['modeOperation_id'];
            $data['actuationMechanism_id'] = $dataRequest['actuationMechanism_id'];
            $data['applicationRange'] = $dataRequest['applicationRange'];
            $data['numberApplications'] = $dataRequest['numberApplications'];
            $data['note'] = $dataRequest['note'];
        //    $data['image'] = $dataRequest['image'];
            $data['in_use'] = $dataRequest['in_use'];

      // Gravar a atualizacões
      $update = $pesticide->update($data);

      //-----------------  Atualizar Relacionamentos Crop->Pesticide----------------//
      $list_ids = $request; 
      //  Passo1 : Apagar os registros antigo das relações com as doenças
      // Verificar se houve atualizaçao de relacionamentos 
        if($list_ids['afterCrop_id']!= Null OR $list_ids['clearCrop_id'] != Null){     
          // Verificar se tem relacionamentos antigos ou se quer limpar todos
            if($list_ids['beforeCrop_id'] != Null OR $list_ids['clearCrop_id'] != Null) 
            {//  Criar um array dos relacionamentos antigos
              $beforesCrop_id = array_keys($list_ids['beforeCrop_id']); 
              // Eliminar os relacionamentos antigos     
              foreach($beforesCrop_id as $beforeCrop_id){
                $pesticide->crops()->detach($beforeCrop_id);} // =======> trocar     
            }
          //Passo 2 : Ler os relacionamentos atualizados
          // Verificar se houve solicitacao de limpar todos relacionamentos
          if($list_ids['clearCrop_id'] == Null AND $list_ids['afterCrop_id'] != null) 
          {
             //  Criar um array dos relacionamentos
              $aftersCrop_id = array_keys($list_ids['afterCrop_id']); 
         //     dd($request,$afters_id,$pesticide);
            // Gravar a atualizacao dos relacionamentos  
              foreach($aftersCrop_id as $afterCrop_id)
                {  $pesticide->crops()->attach($afterCrop_id);} // =======> trocar         
          }
        }

//-----------------  Atualizar Relacionamentos Disease->Pesticide----------------//
      $list_ids = $request; 
      //  Passo1 : Apagar os registros antigo das relações com as doenças
      // Verificar se houve atualizaçao de relacionamentos 
        if($list_ids['afterDisease_id']!= Null OR $list_ids['clearDisease_id'] != Null){     
          // Verificar se tem relacionamentos antigos ou se quer limpar todos
            if($list_ids['beforeDisease_id'] != Null OR $list_ids['clearDisease_id'] != Null) 
            {//  Criar um array dos relacionamentos antigos
              $beforesDisease_id = array_keys($list_ids['beforeDisease_id']); 
              // Eliminar os relacionamentos antigos     
              foreach($beforesDisease_id as $beforeDisease_id){
                $pesticide->diseases()->detach($beforeDisease_id);} // =======> trocar     
            }
          //Passo 2 : Ler os relacionamentos atualizados
          // Verificar se houve solicitacao de limpar todos relacionamentos
          if($list_ids['clearDisease_id'] == Null AND $list_ids['afterDisease_id'] != null) 
          {
             //  Criar um array dos relacionamentos
              $aftersDisease_id = array_keys($list_ids['afterDisease_id']); 
         //     dd($request,$afters_id,$pesticide);
            // Gravar a atualizacao dos relacionamentos  
              foreach($aftersDisease_id as $afterDisease_id)
                {  $pesticide->diseases()->attach($afterDisease_id);} // =======> trocar         
          }
        }

     //-----------------  Atualizar Relacionamentos active_principle->Pesticide----------------//
     $list_ids = $request; 
     //  Passo1 : Apagar os registros antigo das relações com as doenças
     // Verificar se houve atualizaçao de relacionamentos 
       if($list_ids['afterActive_principle_id']!= Null OR $list_ids['clearActive_principle_id'] != Null){     
         // Verificar se tem relacionamentos antigos ou se quer limpar todos
           if($list_ids['beforeActive_principle_id'] != Null OR $list_ids['clearActive_principle_id'] != Null) 
           {//  Criar um array dos relacionamentos antigos
             $beforesActive_principle_id = array_keys($list_ids['beforeActive_principle_id']); 
             // Eliminar os relacionamentos antigos     
             foreach($beforesActive_principle_id as $beforeActive_principle_id){
               $pesticide->active_principles()->detach($beforeActive_principle_id);} // =======> trocar     
           }
         //Passo 2 : Ler os relacionamentos atualizados
         // Verificar se houve solicitacao de limpar todos relacionamentos
         if($list_ids['clearActive_principle_id'] == Null AND $list_ids['afterActive_principle_id'] != null) 
         {
            //  Criar um array dos relacionamentos
             $aftersActive_principle_id = array_keys($list_ids['afterActive_principle_id']); 
        //     dd($request,$afters_id,$pesticide);
           // Gravar a atualizacao dos relacionamentos  
             foreach($aftersActive_principle_id as $afterActive_principle_id){
                 $pesticide->active_principles()->attach($afterActive_principle_id);} // =======> trocar         
         }
       }
        if ($update)
        return redirect()
                        ->route('pesticide.show' ,[ 'pesticide' => $pesticide->id ])
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
    public function destroy(Pesticide $pesticide)
    {

    //  dd($pesticide->id);
      $pesticide_name  = $pesticide->name;
       
      $destroy = $pesticide->delete();

           
      if ($destroy)
      {

            return redirect()
                            ->route('pesticide.index')
                            ->with('danger', 'A defensivo '. $pesticide_name . ' foi deletada com sucesso');
                    

            return redirect()
                    ->back()
                    ->with('error',  'Falha na deleção a cultura');

        }

     //   dd($destroy);
        
  
     //   return redirect('crop.index');
    }

    public function trocanomecoluna()
    {

      pesticide::table('pesticide', function ($table) {
        $table->renameColumn('agronomicClass_id', 'agronomic_class_id');
      });

      dd('feito');
       
    }
    private function validateRequest()
    {

        return request()->validate([


            'user_id'                 => 'required',
            'name'                    => 'required',
            'manufacturer_id'         => 'required',
            'agronomicClass_id'       => 'required',
            'formulationType_id'      => 'required',
            'dosage'                  => 'required',
            'unity'                   => 'required',
            'applicationMode_id'      => 'required',
            'toxicologicalClass_id'   => 'required',
            'chemicalGroup_id'        => 'required',
            'actionSite_id'           => 'required',
            'modeOperation_id'        => 'required',
            'actuationMechanism_id'      => 'required',
            'applicationRange'        => 'required',
            'numberApplications'      => 'required',
            'note'                    => 'required',
      //      'image'                   => 'required',
            'in_use'                  => 'required',
    
       ]);

    }
}
