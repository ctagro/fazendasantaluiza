<?php

namespace App\Http\Controllers\Plantetc\Robocar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Robocar\Temperatura;
use Redirect;

class TemperaturaController extends Controller
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

    $temperaturas = Temperatura::all();


     //dd($temperaturas);   

        return view('temperatura.temperatura.index', ['temperaturas' => $temperaturas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $temperaturas = new \App\Models\robocar\temperatura([


        ]);

        return view('plantetc.robocar.temperatura.create',compact('temperaturas'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, temperatura $temperatura)
    {
        
        $data = $this->validateRequest();

        $temperatura = new temperatura();

        $response = $temperatura->storetemperatura($data);

      // dd($response['sucess']);

        if ($response['sucess'])

            return redirect()
                            ->route('temperatura.chart')
                            ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar o funcionário');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(temperatura $temperatura)
    {

      //  $user_login_id = auth()->user()->id;
      //  $user = auth()->user();

      $temperaturas = auth()->user()->temperatura()->get();


        return view('temperatura.temperatura.show', compact('temperatura' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(temperatura $temperatura) {


        $user = auth()->user();


        return view('temperatura.temperatura.edit',['temperatura' => $temperatura]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, temperatura $temperatura)
    {

        $dataRequest = $this->validateRequest();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $nameFile = $temperatura['image'];
              
            if  ($nameFile == "temperatura_avatar.png"){
    
                //cria um nome para a imagem concatenado id e nome do user
                $name = 'temperatura_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $temperatura['image'] = $nameFile;
                //dd($nameFile);
            }
        
            $upload = $request->file('image')->storeAs('temperaturas', $nameFile);
        }


        $data['name'] = $dataRequest['name'];
        $data['area'] = $dataRequest['area'];
        $data['location'] = $dataRequest['location'];
        $data['in_use']   = $dataRequest['in_use'];
       

        $update = $temperatura -> update($data);

        if ($update)

        return redirect()
                        ->route('temperatura.edit' ,[ 'temperatura' => $temperatura->id ])
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
    public function destroy(temperatura $temperatura)
    {
        $path = 'temperaturas/'.$temperatura['image'];

        if($path != "temperaturas/temperatura_avatar.png")

        Storage::delete($path);

        $destroy = $temperatura->delete();

        return redirect('/temperatura');
    }

    private function validateRequest()
    {

        return request()->validate([

            'medidor'      => 'required',
            'valor'      => 'required',
            'location'  => 'required',
    
       ]);


    }
}
