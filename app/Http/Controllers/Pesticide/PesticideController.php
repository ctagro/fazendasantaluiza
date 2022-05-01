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
      

      $pesticides = Pesticide::get();

      $users = User::all();

      $chemicalGroups = ChemicalGroup::all();

    // dd($users);

    // dd($chemicalGroups);

   // dd($pesticide,$chemicalGroup,$pesticide->chemicalGroup);
  //    $pets = Pesticide::find(1)->chemicalGroup()->where('id','chemicalGroup_id');
    //dd($user,$pesticide);
      //dd($user->pesticide->name);

    //  dd($pesticides,$manufactureres,$chemicalGroups);

      

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

     //  dd($pesticides,$count);

       // return view('plantetc.crop.create',compact('crop')); // definitivo
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

   //  dd($request);

        // Capturando os dados da Cultura    
        $data = $this->validateRequest(); 

     //   dd($data['user_id']);

        $userName['user_id'] = auth()->user()->name;

   //     dd($data,$request,$data['name'],$data['user_id'],$userName);

        $pesticide_entry = Pesticide::where('name', '=', $data['name'])->get()->count();



  /*      if($pesticide_entry > 0){


        //  dd($pesticide_entry);
            return redirect()
            ->route('pesticide.create')
            ->with('error',  'O defensivo '. $data['name'].' ja foi cadastrada');
        }
  */
        // Capturando os dados dos defensivos selecionado  

        $pesticides= $request;

    //  dd($pesticides,$pesticides['active_principle_id']);

        $pesticide = new pesticide();

        $response = $pesticide->storePesticide($data);

        $pesticide_id = $response['new_pesticide'];

    //    dd($pesticide_id);

        $pesticide = Pesticide::find($pesticide_id);
        
// ===============  Relação defensivo com cultura  ===========
        if($pesticides['crop_id'] != null)
        {
            $crops_id = array_keys($pesticides['crop_id']);
            foreach($crops_id as $crop_id)
                {
                     $pesticide->crops()->attach($crop_id);
                }
        }
       
// ===============  Relação defensivo com doença  ===========
        if($pesticides['disease_id'] != null)
        {
            $diseases_id = array_keys($pesticides['disease_id']);
            foreach($diseases_id as $disease_id)
                {
                     $pesticide->diseases()->attach($disease_id);
                }
        }

// ===============  Relação defensivo com Princípio ativo  ===========
        if($pesticides['active_principle_id'] != null)
        {
            $active_principles_id = array_keys($pesticides['active_principle_id']);
      //      dd($request,$pesticides['active_principle_id'],$active_principles_id);
            foreach($active_principles_id as $active_principle_id)
                {
                    $pesticide->active_principles()->attach($active_principle_id);
                }
        }

        
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
        $pesticide = Pesticide::find($pesticide_id);

        $user = auth()->user();

        $pesticide_name = $pesticide->name;

       // dd($pesticide_name);
        
        $count = count($pesticide->crops);
        
     //  dd($pesticide_name,($count>0));
        
        $crops = $pesticide->crops;

    //  dd($crops);
    


        return view('plantetc.pesticide.show', compact('crops','pesticide' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesticide $pesticide) {

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

   // Para listar as culturas e as que relacionam co pesticide
      $crops = Crop::all();
      $pesticide_crops_result = [];
      $pesticide_crops = $pesticide->crops;
      $count = count($crops);
      $index = [];
      $i=0;
    // Criando o array com os indices das defensivos relacionadas
       foreach($pesticide_crops as $pesticide_crop){ 
          $index[$i] = $pesticide_crop->id;
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
            $pesticide_crops_result[$i] = ($pesticide_crops[$j]->id);
            $j++;
              if($j >= $count_j)
              {
                $j = $j-1;
              }
          }
          else{
            $pesticide_crops_result[$i] = 999;
          }
      }
      else
      {
        $pesticide_crops_result[$i] = 999; 
      }

        // populando um arry com o nomes das defensivos
        $names[$i] = 'name'. $i;
    }
      //renomeando o arry resultante
      $pesticide_crops = $pesticide_crops_result;

 //=============== Para listar as diseases e as que relacionam co pesticide
 $diseases = Disease::all();
 $pesticide_diseases_result = [];
 $pesticide_diseases = $pesticide->diseases;
 $count = count($diseases);
 $index = [];
 $i=0;
// Criando o array com os indices das defensivos relacionadas
  foreach($pesticide_diseases as $pesticide_disease){ 
     $index[$i] = $pesticide_disease->id;
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
       $pesticide_diseases_result[$i] = ($pesticide_diseases[$j]->id);
       $j++;
         if($j >= $count_j)
         {
           $j = $j-1;
         }
     }
     else{
       $pesticide_diseases_result[$i] = 999;
     }
 }
 else
 {
   $pesticide_diseases_result[$i] = 999; 
 }

   // populando um arry com o nomes das defensivos
   $names[$i] = 'name'. $i;
}
 //renomeando o arry resultante
 $pesticide_diseases = $pesticide_diseases_result;

 //=============== Para listar as diseases e as que relacionam co pesticide
 $active_principles = ActivePrinciple::all();
 $pesticide_active_principles_result = [];
 $pesticide_active_principles = $pesticide->active_principles;
 $count = count($active_principles);
 $index = [];
 $i=0;
// Criando o array com os indices das defensivos relacionadas
  foreach($pesticide_active_principles as $pesticide_active_principle){ 
     $index[$i] = $pesticide_active_principle->id;
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
       $pesticide_active_principles_result[$i] = ($pesticide_active_principles[$j]->id);
       $j++;
         if($j >= $count_j)
         {
           $j = $j-1;
         }
     }
     else{
       $pesticide_active_principles_result[$i] = 999;
     }
 }
 else
 {
   $pesticide_active_principles_result[$i] = 999; 
 }

   // populando um arry com o nomes das defensivos
   $names[$i] = 'name'. $i;
}
 //renomeando o arry resultante
 $pesticide_active_principles = $pesticide_active_principles_result;


 

        return view('plantetc.pesticide.edit',compact('pesticide','crops','diseases','active_principles',
                                                    'pesticide_crops','pesticide_diseases','pesticide_active_principles',                                                
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

      $update = $pesticide->update($data);

     $crop_update = Pesticide::find($pesticide['id']);

     // Updade das relações

        $crops = $request;
     //  dd($crops); 


        $pesticide_crops = $pesticide->crops;

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
               // dd($pesticide_id);
                $pesticide->crops()->detach($crop_id);           

            }
      
    }
//dd($pesticides[$pesticide_id]);
$crops = $request;
//dd($pesticides);

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
                $pesticide->crops()->attach($crop_id);
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

    //  dd($pesticide);
      $pesticide_name  = $pesticide->name;
       
        $destroy = $pesticide->delete();

           
      if ($destroy)
      {

            return redirect()
                            ->route('pesticide.index')
                            ->with('sucess', 'A defensivo '. $pesticide_name . ' foi deletada com sucesso');
                    

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
