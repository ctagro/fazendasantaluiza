<?php

namespace App\Http\Controllers\Plantetc\Robocar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Robocar\Umidade;

class UmidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        

        return view('plantetc.robocar.umidade.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Umidade $umidade)
    {
        $dataRequest = $this->validateRequest();
        
        $data['valor'] = $dataRequest['valor'];

        $umidade = new Umidade();

        $response = $umidade->storeUmidade($data);

      //  dd($response['sucess']);

       // return redirect()->route('umidade.chart');

        if ($response['sucess'])

            return redirect()
                            ->route('umidade.chart')
                            ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar o funcionário');


    }

    public function chart()
    {
        $umidades = Umidade::all();

       
    //  echo($valores_json);
        
        return view('plantetc.robocar.umidade.list',compact('umidades'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function validateRequest()
    {

        return request()->validate([

            'valor'      => 'required',
    
       ]);
    }
}
