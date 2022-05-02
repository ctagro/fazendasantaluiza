<?php

namespace App\Http\Controllers\Pesticide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\User;
Use App\Models\ActivePrinciple;
Use App\Models\Defensivo;
Use App\Models\ActivePrinciple_defensivo;
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

    //    dd($activePrinciples);

        return view('plantetc.activePrinciple.index', ['activePrinciples' => $activePrinciples]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();

        $activePrinciple = new \App\Models\ActivePrinciple([

       

        ]);

        $defensivos = Defensivo::all();

        $count = count($defensivos);

     //  dd($defensivos,$count);

       // return view('plantetc.activePrinciple.create',compact('ActivePrinciple')); // definitivo
       return view('plantetc.activePrinciple.create',compact('activePrinciple','defensivos','count')); //teste
       
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

      //  dd($data);

        $ActivePrinciple_entry = ActivePrinciple::where('name', '=', $data['name'])->get()->count();

        //   dd($ActivePrinciple_entry);

        if($ActivePrinciple_entry > 0){


     
            return redirect()
            ->route('activePrinciple.create')
            ->with('error',  'O princípio ativo '. $data['name'].' ja foi cadastrado');
        }

        // Capturando os dados da das doenças slecionado  

        $defensivos= $request;

    //  dd($defensivos);

        $ActivePrinciple = new ActivePrinciple();

        $response = $ActivePrinciple->storeActivePrinciple($data);

        $ActivePrinciple_id = $response['new_ActivePrinciple'];

        $ActivePrinciple = ActivePrinciple::find($ActivePrinciple_id);
 
        

        if($defensivos['defensivo_id'] != null)
        {
            $defensivos_id = array_keys($defensivos['defensivo_id']);
        //   dd($defensivos_id);
            foreach($defensivos_id as $defensivo_id)
                {
       //             dd($defensivo_id);
                    $ActivePrinciple->defensivos()->attach($defensivo_id);

                }
                
         //     $defensivo = Defensivo::findOrFail($defensivos_id[0]);

        }
       
      if ($response)
      {

            return redirect()
                            ->route('activePrinciple.create')
                            ->with('sucess', 'Cadastro de '. $ActivePrinciple->name . ' realizado com sucesso');
                    

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

    //    dd($ActivePrinciple_id);
        // ++> verificar se precisa dessa linha
        $activePrinciple = ActivePrinciple::find($ActivePrinciple_id);

        $user = auth()->user();

        $activePrinciple_name = $activePrinciple->name;

       // dd($ActivePrinciple_name);
        
        $count = count($activePrinciple->defensivos);
        
     //  dd($ActivePrinciple_name,($count>0));
        
        $defensivos = $activePrinciple->defensivos;

   //   dd($defensivos);
   
      
   //   dd($ActivePrinciple,$ActivePrinciple->name,$defensivo['name'],$count);
      
      
      
      //dd('0k');


        return view('plantetc.activePrinciple.show', compact('activePrinciple','defensivos' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(activePrinciple $activePrinciple) {

  // dd($activePrinciple);

        $user = auth()->user();

        // Para listar todas as doenças

      $defensivos = Defensivo::all();

      // para listar as doenças relacionadas à cultura

      $activePrinciple_defensivos = $activePrinciple->defensivos;

     // dd($activePrinciple_defensivos);
      
      // criando o array que lista todas as culturas e marca as que sào
      // relacionadas à cultura em questão

      $activePrinciple_defensivos_result = [];

      $count = count($defensivos);
      $index = [];
      $i=0;

      // Criando o array com os indices das doenças relacionadas

       foreach($activePrinciple_defensivos as $activePrinciple_defensivo){ 
          $index[$i] = $activePrinciple_defensivo->id;
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
            $activePrinciple_defensivos_result[$i] = ($activePrinciple_defensivos[$j]->id);
            $j++;
              if($j >= $count_j)
              {
                $j = $j-1;
              }
          }
          else{
            $activePrinciple_defensivos_result[$i] = 999;
          }
      }
      else
      {
        $activePrinciple_defensivos_result[$i] = 999; 
      }

        // populando um arry com o nomes das doenças
        $names[$i] = 'name'. $i;
    }

     // dd($names);
     // dd($activePrinciple_defensivos, $ActivePrinciple_defensivos_result);

      //renomeando o arry resultante
      $activePrinciple_defensivos = $activePrinciple_defensivos_result;

    // dd($ActivePrinciple_defensivos);


        return view('plantetc.activePrinciple.edit',['activePrinciple' => $activePrinciple , 'defensivos' => $defensivos, 'names' => $names, 'activePrinciple_defensivos' => $activePrinciple_defensivos]);
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
     // dd($activePrinciple,$request,$activePrinciple['user_id']);
     // Update do campos do registro

     if ($request['note'] == null){
      $request['note'] = "...";
      }

      $dataRequest = $this->validateRequest();

     

      $data['user_id']          = $activePrinciple['user_id'];
      $data['name']             = $dataRequest['name'];
      $data['agronomicClass_id']= $dataRequest['agronomicClass_id'];
      $data['description']      = $dataRequest['description'];
      $data['in_use']           = $dataRequest['in_use'];  
      $data['note']             = $dataRequest['note'];

  //   dd($data);
     
      $update = $activePrinciple->update($data);

     $activePrinciple_update = ActivePrinciple::find($activePrinciple['id']);

     // Updade das relações

        $defensivos = $request;
     //  dd($defensivos); 


        $activePrinciple_defensivos = $activePrinciple->defensivos;

//  Apagar os registros antigo das relações com as doenças

    if($defensivos['defensivo_id'] != null)
    {
        $defensivos_id = array_keys($defensivos['defensivo_id']);
       
       $count = count($defensivos_id); 
     //  dd($defensivos_id,$count);
       for ($i = 0; $i < $count; $i++) {
         $defensivos_id[$i] =  $defensivos_id[$i]+1;
       }
      //  dd($defensivos_id,$count);

        foreach($defensivos_id as $defensivo_id)
            {
               // dd($defensivo_id);
                $activePrinciple->defensivos()->detach($defensivo_id);           

            }
      
    }
//dd($defensivos[$defensivo_id]);
$defensivos = $request;
//dd($defensivos);

  // registrar as novas relações

    if($defensivos['defensivo_id'] != null)
    {
        $defensivos_id = array_keys($defensivos['defensivo_id']);

        $count = count($defensivos_id); 
       //  dd($defensivos_id,$count);
          for ($i = 0; $i < $count; $i++) {
            $defensivos_id[$i] =  $defensivos_id[$i]+1;
          }
       //   dd($defensivos_id,$count);
        foreach($defensivos_id as $defensivo_id)
            {
                $activePrinciple->defensivos()->attach($defensivo_id);
            }
     
    }

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

     //   dd($destroy);
        
  
     //   return redirect('ActivePrinciple.index');
    }

    private function validateRequest()
    {

        return request()->validate([

     
            'name'                  => 'required',
            'agronomicClass_id'     => 'required',
            'description'           => 'required',
            'note'                  => 'required',
            'in_use'                => 'required',
    
       ]);

    }
}
