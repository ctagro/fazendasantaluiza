<?php

namespace App\Http\Controllers\Pesticide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\User;
Use App\Models\ActivePrinciple;
Use App\Models\Pesticide;
Use App\Models\ActivePrinciple_pesticide;
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

        $pesticides = Pesticide::all();

        $count = count($pesticides);

     //  dd($pesticides,$count);

       // return view('plantetc.activePrinciple.create',compact('ActivePrinciple')); // definitivo
       return view('plantetc.activePrinciple.create',compact('activePrinciple','pesticides','count')); //teste
       
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

        $pesticides= $request;

    //  dd($pesticides);

        $ActivePrinciple = new ActivePrinciple();

        $response = $ActivePrinciple->storeActivePrinciple($data);

        $ActivePrinciple_id = $response['new_ActivePrinciple'];

        $ActivePrinciple = ActivePrinciple::find($ActivePrinciple_id);
 
        

        if($pesticides['pesticide_id'] != null)
        {
            $pesticides_id = array_keys($pesticides['pesticide_id']);
        //   dd($pesticides_id);
            foreach($pesticides_id as $pesticide_id)
                {
       //             dd($pesticide_id);
                    $ActivePrinciple->pesticides()->attach($pesticide_id);

                }
                
         //     $pesticide = Pesticide::findOrFail($pesticides_id[0]);

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
        
        $count = count($activePrinciple->pesticides);
        
     //  dd($ActivePrinciple_name,($count>0));
        
        $pesticides = $activePrinciple->pesticides;

   //   dd($pesticides);
   
      
   //   dd($ActivePrinciple,$ActivePrinciple->name,$pesticide['name'],$count);
      
      
      
      //dd('0k');


        return view('plantetc.activePrinciple.show', compact('activePrinciple','pesticides' ));



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

      $pesticides = Pesticide::all();

      // para listar as doenças relacionadas à cultura

      $activePrinciple_pesticides = $activePrinciple->pesticides;

     // dd($activePrinciple_pesticides);
      
      // criando o array que lista todas as culturas e marca as que sào
      // relacionadas à cultura em questão

      $activePrinciple_pesticides_result = [];

      $count = count($pesticides);
      $index = [];
      $i=0;

      // Criando o array com os indices das doenças relacionadas

       foreach($activePrinciple_pesticides as $activePrinciple_pesticide){ 
          $index[$i] = $activePrinciple_pesticide->id;
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
            $activePrinciple_pesticides_result[$i] = ($activePrinciple_pesticides[$j]->id);
            $j++;
              if($j >= $count_j)
              {
                $j = $j-1;
              }
          }
          else{
            $activePrinciple_pesticides_result[$i] = 999;
          }
      }
      else
      {
        $activePrinciple_pesticides_result[$i] = 999; 
      }

        // populando um arry com o nomes das doenças
        $names[$i] = 'name'. $i;
    }

     // dd($names);
     // dd($activePrinciple_pesticides, $ActivePrinciple_pesticides_result);

      //renomeando o arry resultante
      $activePrinciple_pesticides = $activePrinciple_pesticides_result;

    // dd($ActivePrinciple_pesticides);


        return view('plantetc.activePrinciple.edit',['activePrinciple' => $activePrinciple , 'pesticides' => $pesticides, 'names' => $names, 'activePrinciple_pesticides' => $activePrinciple_pesticides]);
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

        $pesticides = $request;
     //  dd($pesticides); 


        $activePrinciple_pesticides = $activePrinciple->pesticides;

//  Apagar os registros antigo das relações com as doenças

    if($pesticides['pesticide_id'] != null)
    {
        $pesticides_id = array_keys($pesticides['pesticide_id']);
       
       $count = count($pesticides_id); 
     //  dd($pesticides_id,$count);
       for ($i = 0; $i < $count; $i++) {
         $pesticides_id[$i] =  $pesticides_id[$i]+1;
       }
      //  dd($pesticides_id,$count);

        foreach($pesticides_id as $pesticide_id)
            {
               // dd($pesticide_id);
                $activePrinciple->pesticides()->detach($pesticide_id);           

            }
      
    }
//dd($pesticides[$pesticide_id]);
$pesticides = $request;
//dd($pesticides);

  // registrar as novas relações

    if($pesticides['pesticide_id'] != null)
    {
        $pesticides_id = array_keys($pesticides['pesticide_id']);

        $count = count($pesticides_id); 
       //  dd($pesticides_id,$count);
          for ($i = 0; $i < $count; $i++) {
            $pesticides_id[$i] =  $pesticides_id[$i]+1;
          }
       //   dd($pesticides_id,$count);
        foreach($pesticides_id as $pesticide_id)
            {
                $activePrinciple->pesticides()->attach($pesticide_id);
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
