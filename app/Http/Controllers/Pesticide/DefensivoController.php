<?php

namespace App\Http\Controllers\Pesticide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\User;
Use App\Models\Crop;
Use App\Models\Disease;
Use App\Models\Defensivo;
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


class DefensivoController extends Controller
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


  //    $manufacturers = Manufacturer::all();
  //    $chemicalGroups = ChemicalGroup::all();
  //    $agronomicClasses = AgronomicClass::all();
      

      $defensivos = Defensivo::get();

  //    $users = User::all();

  //    $chemicalGroups = ChemicalGroup::all();

    // dd($users);

   //  dd($chemicalGroups);

   // dd($defensivo,$chemicalGroup,$defensivo->chemicalGroup);
  //    $pets = Defensivo::find(1)->chemicalGroup()->where('id','chemicalGroup_id');
    //dd($user,$defensivo);
      //dd($user->defensivo->name);

    //  dd($defensivos,$manufactureres,$chemicalGroups);

      

          return view('plantetc.defensivo.index', compact('defensivos'));
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

        $defensivo= new \App\Models\Defensivo([   

        ]);

        $crops = Crop::all();
        $count_crops = count($crops);

        $diseases = Disease::all();
        $count_diseases = count($crops);

        $active_principles = ActivePrinciple::all();
        $count_active_principles = count($crops);


       return view('plantetc.defensivo.create',compact('defensivo','crops','count_crops','diseases',
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

   //  dd($request);

        // Capturando os dados da Cultura    
        $data = $this->validateRequest(); 

     //   dd($data['user_id']);

        $userName['user_id'] = auth()->user()->name;

   //     dd($data,$request,$data['name'],$data['user_id'],$userName);

        $defensivo_entry = Defensivo::where('name', '=', $data['name'])->get()->count();



  /*      if($defensivo_entry > 0){


        //  dd($defensivo_entry);
            return redirect()
            ->route('defensivo.create')
            ->with('error',  'O defensivo '. $data['name'].' ja foi cadastrada');
        }
  */
        // Capturando os dados dos defensivos selecionado  

        $defensivos= $request;

    //  dd($defensivos,$defensivos['active_principle_id']);

        $defensivo = new defensivo();

        $response = $defensivo->storeDefensivo($data);

        $defensivo_id = $response['new_defensivo'];

    //    dd($defensivo_id);

        $defensivo = Defensivo::find($defensivo_id);
        
// ===============  Relação defensivo com cultura  ===========
        if($defensivos['crop_id'] != null)
        {
            $crops_id = array_keys($defensivos['crop_id']);
            foreach($crops_id as $crop_id)
                {
                     $defensivo->crops()->attach($crop_id);
                }
        }
       
// ===============  Relação defensivo com doença  ===========
        if($defensivos['disease_id'] != null)
        {
            $diseases_id = array_keys($defensivos['disease_id']);
            foreach($diseases_id as $disease_id)
                {
                     $defensivo->diseases()->attach($disease_id);
                }
        }

// ===============  Relação defensivo com Princípio ativo  ===========
        if($defensivos['active_principle_id'] != null)
        {
            $active_principles_id = array_keys($defensivos['active_principle_id']);
      //      dd($request,$defensivos['active_principle_id'],$active_principles_id);
            foreach($active_principles_id as $active_principle_id)
                {
                    $defensivo->active_principles()->attach($active_principle_id);
                }
        }

        
      if ($response)
      {

            return redirect()
                            ->route('defensivo.create')
                            ->with('sucess', 'Cadastro de '. $defensivo->name . ' realizado com sucesso');
                    

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
    public function show($defensivo_id)
    {
        // ++> verificar se precisa dessa linha

        $agronomicClasses         = AgronomicClass::all();
        $formulationTypes         = FormulationType::all();
        $manufacturers            = Manufacturer::all();
        $applicationModes         = ApplicationMode::all();
        $chemicalGroups           = ChemicalGroup::all();
        $toxicologicalClasses     = ToxicologicalClass::all();
        $actionSites              = ActionSite::all();
        $modeOperations           = ModeOperation::all();
        $actuationMechanisms      = ActuationMechanism::all();
        $defensivo = Defensivo::find($defensivo_id);

        $user = auth()->user();

        $defensivo_name = $defensivo->name;

       // dd($defensivo_name);
        
        $count = count($defensivo->crops);
        
     //  dd($defensivo_name,($count>0));
        
        $crops = $defensivo->crops;

  
    


        return view('plantetc.defensivo.show', compact('crops','defensivo' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Defensivo $defensivo) {

      $user = auth()->user();

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

   // Para listar as culturas e as que relacionam co defensivo
      $crops = Crop::all();
      $defensivo_crops_result = [];
      $defensivo_crops = $defensivo->crops;
      $count = count($crops);
      $index = [];
      $i=0;
    // Criando o array com os indices das defensivos relacionadas
       foreach($defensivo_crops as $defensivo_crop){ 
          $index[$i] = $defensivo_crop->id;
          $i++;
       }
       $index1 = array_keys($index); 
    $j = 0;
    $count_j = count($index);
    $names = [];

    // Populando o arry resultante com todas as defensivos e setando as relacionadas
 
    for ($i = 0; $i < $count; $i++)
    {
    // dd($i,$index[$j]);
    if($count_j>0)
      {
          if(($i+1) == ($index[$j]) )
          {
            $defensivo_crops_result[$i] = ($defensivo_crops[$j]->id);
            $j++;
              if($j >= $count_j)
              {
                $j = $j-1;
              }
          }
          else{
            $defensivo_crops_result[$i] = 999;
          }
      }
      else
      {
        $defensivo_crops_result[$i] = 999; 
      }

        // populando um arry com o nomes das defensivos
        $names[$i] = 'name'. $i;
    }
      //renomeando o arry resultante
      $defensivo_crops = $defensivo_crops_result;

 //=============== Para listar as diseases e as que relacionam co defensivo
 $diseases = Disease::all();
 $defensivo_diseases_result = [];
 $defensivo_diseases = $defensivo->diseases;
 $count = count($diseases);
 $index = [];
 $i=0;
// Criando o array com os indices das defensivos relacionadas
  foreach($defensivo_diseases as $defensivo_disease){ 
     $index[$i] = $defensivo_disease->id;
     $i++;
  }
  $index1 = array_keys($index); 
$j = 0;
$count_j = count($index);
$names = [];

// Populando o arry resultante com todas as defensivos e setando as relacionadas

for ($i = 0; $i < $count; $i++)
{
// dd($i,$index[$j]);
if($count_j>0)
 {
     if(($i+1) == ($index[$j]) )
     {
       $defensivo_diseases_result[$i] = ($defensivo_diseases[$j]->id);
       $j++;
         if($j >= $count_j)
         {
           $j = $j-1;
         }
     }
     else{
       $defensivo_diseases_result[$i] = 999;
     }
 }
 else
 {
   $defensivo_diseases_result[$i] = 999; 
 }

   // populando um arry com o nomes das defensivos
   $names[$i] = 'name'. $i;
}
 //renomeando o arry resultante
 $defensivo_diseases = $defensivo_diseases_result;

 //=============== Para listar as diseases e as que relacionam co defensivo
 $active_principles = ActivePrinciple::all();
 $defensivo_active_principles_result = [];
 $defensivo_active_principles = $defensivo->active_principles;
 $count = count($active_principles);
 $index = [];
 $i=0;
// Criando o array com os indices das defensivos relacionadas
  foreach($defensivo_active_principles as $defensivo_active_principle){ 
     $index[$i] = $defensivo_active_principle->id;
     $i++;
  }
  $index1 = array_keys($index); 
$j = 0;
$count_j = count($index);
$names = [];

// Populando o arry resultante com todas as defensivos e setando as relacionadas

for ($i = 0; $i < $count; $i++)
{
// dd($i,$index[$j]);
if($count_j>0)
 {
     if(($i+1) == ($index[$j]) )
     {
       $defensivo_active_principles_result[$i] = ($defensivo_active_principles[$j]->id);
       $j++;
         if($j >= $count_j)
         {
           $j = $j-1;
         }
     }
     else{
       $defensivo_active_principles_result[$i] = 999;
     }
 }
 else
 {
   $defensivo_active_principles_result[$i] = 999; 
 }

   // populando um arry com o nomes das defensivos
   $names[$i] = 'name'. $i;
}
 //renomeando o arry resultante
 $defensivo_active_principles = $defensivo_active_principles_result;


//dd($chemicalGroups) ;

        return view('plantetc.defensivo.edit',compact('defensivo','crops','diseases','active_principles',
                                                    'defensivo_crops','defensivo_diseases','defensivo_active_principles',                                                
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
    public function update(Request $request, Defensivo $defensivo)
    {
      
     // Update do campos do registro

     $request['user_id'] = auth()->user()->id;

     if ($request['note'] == null){
      $request['note'] = "...";
      }
   //   dd($request);


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

      $update = $defensivo->update($data);

     $crop_update = Defensivo::find($defensivo['id']);

     // Updade das relações

        $crops = $request;
     //  dd($crops); 


        $defensivo_crops = $defensivo->crops;

//  Apagar os registros antigo das relações com as defensivos

    if($crops['crop_id'] != null)
    {
        $crops_id = array_keys($crops['crop_id']);
       
       $count = count($crops_id); 
     //  dd($crops_id,$count);
       for ($i = 0; $i < $count; $i++) {
         $crops_id[$i] =  $crops_id[$i]+1;
       }
      //  dd($crops_id,$count);

        foreach($crops_id as $crop_id)
            {
               // dd($defensivo_id);
                $defensivo->crops()->detach($crop_id);           

            }
      
    }
//dd($defensivos[$defensivo_id]);
$crops = $request;
//dd($defensivos);

  // registrar as novas relações

    if($crops['crop_id'] != null)
    {
        $crops_id = array_keys($crops['crop_id']);

        $count = count($crops_id); 
       //  dd($crops_id,$count);
          for ($i = 0; $i < $count; $i++) {
            $crops_id[$i] =  $crops_id[$i]+1;
          }
       //   dd($crops_id,$count);
        foreach($crops_id as $crop_id)
            {
                $defensivo->crops()->attach($crop_id);
            }
     
    }

        if ($update)

        return redirect()
                        ->route('defensivo.show' ,[ 'defensivo' => $defensivo->id ])
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
    public function destroy(Defensivo $defensivo)
    {

    //  dd($defensivo);
      $defensivo_name  = $defensivo->name;
       
        $destroy = $defensivo->delete();

           
      if ($destroy)
      {

            return redirect()
                            ->route('defensivo.index')
                            ->with('sucess', 'A defensivo '. $defensivo_name . ' foi deletada com sucesso');
                    

            return redirect()
                    ->back()
                    ->with('error',  'Falha na deleção a cultura');

        }

     //   dd($destroy);
        
  
     //   return redirect('crop.index');
    }

    public function trocanomecoluna()
    {

      defensivo::table('defensivo', function ($table) {
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
