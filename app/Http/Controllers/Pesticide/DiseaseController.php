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

      //  dd($diseases);

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

     //  dd($diseases,$count);

       // return view('plantetc.crop.create',compact('crop')); // definitivo
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
      
      if ($request['note'] == null){
        $request['note'] = "...";
     }

     

        // Capturando os dados da Cultura    
        $data = $this->validateRequest(); 

        $data['user_id'] = auth()->user()->id;

     //   dd($data['name]);

        $disease_entry = Disease::where('name', '=', $data['name'])->get()->count();



        if($disease_entry > 0){


        //  dd($disease_entry);
            return redirect()
            ->route('disease.create')
            ->with('error',  'A doença '. $data['name'].' ja foi cadastrada');
        }

        // Capturando os dados da das doenças slecionado  

        $crops= $request;

     // dd($crops);

        $crop = new disease();

        $response = $crop->storeDisease($data);

        $disease_id = $response['new_disease'];

        $disease = Disease::find($disease_id);
        

        if($crops['crop_id'] != null)
        {
            $crops_id = array_keys($crops['crop_id']);
       //     dd($crops_id);
            foreach($crops_id as $crop_id)
                {
                    //dd($crop_id);
                    $disease->crops()->attach($crop_id);

                }
                
         //     $disease = Disease::findOrFail($diseases_id[0]);

        }
       
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
        // ++> verificar se precisa dessa linha
        $disease = Disease::find($disease_id);

        $user = auth()->user();

        $disease_name = $disease->name;

       // dd($disease_name);
        
        $count = count($disease->crops);
        
     //  dd($disease_name,($count>0));
        
        $crops = $disease->crops;

    //  dd($crops);
    


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

        // Para listar todas as doenças

      $crops = Crop::all();

      // para listar as doenças relacionadas à cultura

      $disease_crops = $disease->crops;

   
      
      // criando o array que lista todas as doenças e marca as que sào
      // relacionadas à cultura em questão

      $disease_crops_result = [];

      $count = count($crops);
      $index = [];
      $i=0;

      // Criando o array com os indices das doenças relacionadas

       foreach($disease_crops as $disease_crop){ 
          $index[$i] = $disease_crop->id;
          $i++;
       }

       $index1 = array_keys($index);
   //   dd($index,$index1);
 
    $j = 0;
    $count_j = count($index);
    $names = [];
  // dd('i= ',$i, ' j= ', $j, ' count_j= ', $count_j, 'count=', $count);

    // Populando o arry resultante com todas as doenças e setando as relacionadas
 
    for ($i = 0; $i < $count; $i++)
    {
    // dd($i,$index[$j]);
    if($count_j>0)
      {
          if(($i+1) == ($index[$j]) )
          {
            $disease_crops_result[$i] = ($disease_crops[$j]->id);
            $j++;
              if($j >= $count_j)
              {
                $j = $j-1;
              }
          }
          else{
            $disease_crops_result[$i] = 999;
          }
      }
      else
      {
        $disease_crops_result[$i] = 999; 
      }

        // populando um arry com o nomes das doenças
        $names[$i] = 'name'. $i;
    }

     // dd($names);
     // dd($crop_diseases, $crop_diseases_result);

      //renomeando o arry resultante
      $disease_crops = $disease_crops_result;

    // dd($crop_diseases);


        return view('plantetc.disease.edit',['crops' => $crops , 'disease' => $disease, 'names' => $names, 'disease_crops' => $disease_crops]);
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

     if ($request['note'] == null){
      $request['note'] = "...";
      }

      $dataRequest = $this->validateRequest();

     

      $data['user_id']        = $dataRequest['user_id'];
      $data['name']           = $dataRequest['name'];
      $data['scientific_name']= $dataRequest['scientific_name'];
      $data['description']    = $dataRequest['description'];
      $data['symptoms']       = $data[ 'symptoms'];
      $data['control']        = $data[ 'control'];
      $data['in_use']         = $dataRequest['in_use'];  
      $data['note']           = $dataRequest['note'];

      $update = $disease->update($data);

     $crop_update = Disease::find($disease['id']);

     // Updade das relações

        $crops = $request;
     //  dd($crops); 


        $disease_crops = $disease->crops;

//  Apagar os registros antigo das relações com as doenças

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
               // dd($disease_id);
                $disease->crops()->detach($crop_id);           

            }
      
    }
//dd($diseases[$disease_id]);
$crops = $request;
//dd($diseases);

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
                $disease->crops()->attach($crop_id);
            }
     
    }

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

     //   dd($destroy);
        
  
     //   return redirect('crop.index');
    }

    private function validateRequest()
    {

        return request()->validate([

     
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
