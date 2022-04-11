<?php

namespace App\Http\Controllers\Auxiliaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Models\Auxiliaries\Crop_variety;
use App\Models\Crop;
use Redirect;

class Crop_varietyController extends Controller
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

  $crops = Crop::where('id', '>', 4)->get();

 // dd($crops);
 

    $crop_varieties = Crop_variety::get();

 //   $crop_varieties = auth()->user()->crop_variety()->get();



    // $crop_varieties = Crop::all();

  //  dd($crop_varieties);   

        return view('auxiliaries.crop_variety.index', ['crop_varieties' => $crop_varieties, 'crops' => $crops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();

        $crops = Crop::all();

        $crop_variety = new \App\Models\Crop([


        ]);

        return view('auxiliaries.crop_variety.create',compact('crop_variety', 'crops'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Crop_variety $crop_variety)
    {
   
        if ($request['note'] == null){
            $request['note'] = "...";
         }

        $data = $this->validateRequest();

        $crop_variety_entry = Crop_variety::where('name', '=', $data['name'])->get()->count();

    //    dd($crop_variety_entry);

        if($crop_variety_entry > 0){


        //  dd($crop_entry);
            return redirect()
            ->route('crop_variety.create')
            ->with('error',  'A variedade '. $data['name'].' ja foi cadastrada');
        }

    //    dd($data);



        if ($request->file('image') === null){
            $data['image'] = 'crop_variety_avatar.png';
            }
        else{
            if ($request->file('image')->isValid() && $request->file('image')->isValid()) {
          
            //cria um nome para a imagem concatenado id e nome do user
                $name = 'crop_variety_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['image'] = $nameFile;
               
               $upload = $request->file('image')->storeAs('public/crop_varieties', $nameFile);
            }
        }


        $crop_variety = new crop_variety();

        

   //     dd($data);

       

        // Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view groundiro/despesa

        $response = $crop_variety->storeCrop_variety($data);



        if ($response)

            return redirect()
                            ->route('crop_variety.create')
                            ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar a cultura');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Crop_variety $crop_variety)
    {

    
      $user = auth()->user();
      $crops = Crop::all();

      $crop_varieties = Crop_variety::all();

    //  $crop_varieties = auth()->user()->crop_variety()->get();


        return view('auxiliaries.crop_variety.show', compact('crop_variety', 'crops' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Crop_variety $crop_variety) {


        $user = auth()->user();

     //   $crops = Crop::where('in_use', '=', "S")->get();

     $crops = Crop::all();


        return view('auxiliaries.crop_variety.edit',['crop_variety' => $crop_variety, 'crops' => $crops]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crop_variety $crop_variety) 
    {

        if ($request['note'] == null){
            $request['note'] = "...";
         }

        $dataRequest = $this->validateRequest();

     //  dd($crop_variety['image']);

   
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

              $nameFile = $crop_variety['image'];
              
            if  ($nameFile == "crop_variety_avatar.png"){
    
                //cria um nome para a imagem concatenado id e nome do user
                $name = 'crop_variety_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $crop_variety['image'] = $nameFile;
          //      dd($nameFile);
            }
   
            $upload = $request->file('image')->storeAs('public/crop_varieties', $nameFile);
        }

        $data['name']               = $dataRequest['name'];
        $data['crop_id']            = $dataRequest['crop_id'];
        $data['description']        = $dataRequest['description'];
        $data['in_use']             = $dataRequest['in_use'];
        $data['note']             = $dataRequest['note'];
       
    //     dd($data);
        $update = $crop_variety -> update($data);

        if ($update)

        return redirect()
                        ->route('crop_variety.edit' ,[ 'crop_variety' => $crop_variety->id ])
                        ->with('sucess', 'Sucesso ao atualizar');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização do cadastro');     

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crop_variety $crop_variety)
    {  
        $path = 'public/crop_varieties/'.$crop_variety['image'];

      if($path != "public/crop_varieties/crop_variety_avatar.png")

            Storage::delete($path);

        $destroy = $crop_variety->delete();

        if ($destroy)
        {
  
              return redirect()
                              ->route('crop_variety.index')
                              ->with('sucess', 'A variedade '. $crop_variety->name . ' foi deletada com sucesso');
                      
  
              return redirect()
                      ->back()
                      ->with('error',  'Falha na deleção a variedade');
  
          }
  
    }

    private function validateRequest()
    {

        return request()->validate([

            'name'          => 'required',
            'description'   => 'required',
            'crop_id'       => 'required',
            'in_use'        => 'required',
            'note'          => 'required',
    

    
       ]);


    }
}
