<?php

namespace App\Http\Controllers;

use App\Models\Auxiliaries\Crop_variety;
use Illuminate\Http\Request;

use DB;
use App\Models\User;
Use App\Models\Crop;
Use App\Models\Disease;
Use App\Models\Crop_disease;
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

      //  dd($crops);

        return view('plantetc.crop.index', ['crops' => $crops]);
    }

    public function variety($crop_id)
    {

       $crop = Crop::find($crop_id);

        $crop_varieties = Crop_variety::where('crop_id', '=', $crop_id)->get();

     //   dd($varieties);



      //  dd($crops);

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

     //  dd($diseases,$count);

       // return view('plantetc.crop.create',compact('crop')); // definitivo
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
      
      if ($request['note'] == null){
        $request['note'] = "...";
     }

     

        // Capturando os dados da Cultura    
        $data = $this->validateRequest(); 

        $data['user_id'] = auth()->user()->id;

     //   dd($data);

        $crop_entry = Crop::where('name', '=', $data['name'])->get()->count();



        if($crop_entry > 0){


        //  dd($crop_entry);
            return redirect()
            ->route('crop.create')
            ->with('error',  'A cultura '. $data['name'].' ja foi cadastrada');
        }

        // Capturando os dados da das doenças slecionado  

        $diseases= $request;

     // dd($diseases);

        $crop = new crop();

        $response = $crop->storeCrop($data);

        $crop_id = $response['new_crop'];

        $crop = Crop::find($crop_id);
        

        if($diseases['disease_id'] != null)
        {
            $diseases_id = array_keys($diseases['disease_id']);
       //     dd($diseases_id);
            foreach($diseases_id as $disease_id)
                {
                    //dd($disease_id);
                    $crop->diseases()->attach($disease_id);

                }
                
         //     $disease = Disease::findOrFail($diseases_id[0]);

        }
       
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
        // ++> verificar se precisa dessa linha
        $crop = Crop::find($crop_id);

        $user = auth()->user();

        $crop_name = $crop->name;

       // dd($crop_name);
        
        $count = count($crop->diseases);
        
     //  dd($crop_name,($count>0));
        
        $diseases = $crop->diseases;

   //   dd($diseases);
   
      
   //   dd($crop,$crop->name,$disease['name'],$count);
      
      
      
      //dd('0k');


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

        // Para listar todas as doenças

      $diseases = Disease::all();

      // para listar as doenças relacionadas à cultura

      $crop_diseases = $crop->diseases;

     // dd($crop_diseases);
      
      // criando o array que lista todas as culturas e marca as que sào
      // relacionadas à cultura em questão

      $crop_diseases_result = [];

      $count = count($diseases);
      $index = [];
      $i=0;

      // Criando o array com os indices das doenças relacionadas

       foreach($crop_diseases as $crop_disease){ 
          $index[$i] = $crop_disease->id;
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
            $crop_diseases_result[$i] = ($crop_diseases[$j]->id);
            $j++;
              if($j >= $count_j)
              {
                $j = $j-1;
              }
          }
          else{
            $crop_diseases_result[$i] = 999;
          }
      }
      else
      {
        $crop_diseases_result[$i] = 999; 
      }

        // populando um arry com o nomes das doenças
        $names[$i] = 'name'. $i;
    }

     // dd($names);
     // dd($crop_diseases, $crop_diseases_result);

      //renomeando o arry resultante
      $crop_diseases = $crop_diseases_result;

    // dd($crop_diseases);


        return view('plantetc.crop.edit',['crop' => $crop , 'diseases' => $diseases, 'names' => $names, 'crop_diseases' => $crop_diseases]);
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

     if ($request['note'] == null){
      $request['note'] = "...";
      }

      $dataRequest = $this->validateRequest();

     

      $data['user_id']        = $dataRequest['user_id'];
      $data['name']           = $dataRequest['name'];
      $data['scientific_name']= $dataRequest['scientific_name'];
      $data['description']    = $dataRequest['description'];
      $data['in_use']         = $dataRequest['in_use'];  
      $data['note']           = $dataRequest['note'];

      $update = $crop->update($data);

     $crop_update = Crop::find($crop['id']);

     // Updade das relações

        $diseases = $request;
     //  dd($diseases); 


        $crop_diseases = $crop->diseases;

//  Apagar os registros antigo das relações com as doenças

    if($diseases['disease_id'] != null)
    {
        $diseases_id = array_keys($diseases['disease_id']);
       
       $count = count($diseases_id); 
     //  dd($diseases_id,$count);
       for ($i = 0; $i < $count; $i++) {
         $diseases_id[$i] =  $diseases_id[$i]+1;
       }
      //  dd($diseases_id,$count);

        foreach($diseases_id as $disease_id)
            {
               // dd($disease_id);
                $crop->diseases()->detach($disease_id);           

            }
      
    }
//dd($diseases[$disease_id]);
$diseases = $request;
//dd($diseases);

  // registrar as novas relações

    if($diseases['disease_id'] != null)
    {
        $diseases_id = array_keys($diseases['disease_id']);

        $count = count($diseases_id); 
       //  dd($diseases_id,$count);
          for ($i = 0; $i < $count; $i++) {
            $diseases_id[$i] =  $diseases_id[$i]+1;
          }
       //   dd($diseases_id,$count);
        foreach($diseases_id as $disease_id)
            {
                $crop->diseases()->attach($disease_id);
            }
     
    }

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

     
            'name'            => 'required',
            'scientific_name' => 'required',
            'description'     => 'required',
            'note'            => 'required',
            'in_use'          => 'required',
    
       ]);

    }
}
