<?php

namespace App\Http\Controllers\Plantetc\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Support\Arr;
use App\Models\Price_ceasa_bh;
use Exception;
use Illuminate\Database\SchemaBuilder;
Use League\Csv\Reader;
Use League\Csv\Writer;
Use League\Csv\Statement;

class CeasaResearchController extends Controller
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
   

    $cotacoes = Price_ceasa_bh::Price_ceasa_bh()->get();


        return view('plantetc.importe.ceasaBH.ceasa_research.index');
    }

    public function consult()

    {

        $cotacoes = Price_ceasa_bh::get();

       // dd($cotacoes);


    return view('plantetc.import.ceasaBH.ceasa_research.research');

    }
    
    public function research(Request $request)
    {

       $pesquisa = $request;

        $termos = $request->only('product', 'date_inicial', 'date_final' );
        $prepareQuery = "";
        $query = "";
        foreach ($termos as $nome => $valor) {

            if($valor){
              //  $query = $query . "where("."'".$nome."'".","."'"."="."'".","."'". $valor. "')->";
                if ($nome == "product")
                    $prepareQuery = $prepareQuery . $nome. ' LIKE "'. '%'.$valor.'%'. '" AND ';                  
                if ($nome == "date_inicial") 
                        $prepareQuery = $prepareQuery . 'date'. '>="'. $valor. '" AND ';
                if ($nome == "date_final")
                        $prepareQuery = $prepareQuery . 'date'. '<="'. $valor. '" AND ';
            }
         }
   
         $query = substr($prepareQuery, 0 , -5);

     //   dd($query);

        if ($query == False){
            $cotacoes = Price_ceasa_bh::get();
           // dd($cotacoes);
           // dd($cotacoes);
            return view('plantetc.import.ceasaBH.ceasa_research.index', compact('cotacoes'));    
        }

        $cotacoes = Price_ceasa_bh::whereRaw($query)->orderBy('date')->get();
          
       // dd($cotacoes);
        
    return view('plantetc.import.ceasaBH.ceasa_research.index', compact('cotacoes'));
    }
    
    public function file(Request $request)
    {
      
       $pesquisa = $request;

        $termos = $request->only('product', 'date_inicial', 'date_final' );
        $prepareQuery = "";
        $query = "";
        foreach ($termos as $nome => $valor) {

            if($valor){
              //  $query = $query . "where("."'".$nome."'".","."'"."="."'".","."'". $valor. "')->";
                if ($nome == "product")
                    $prepareQuery = $prepareQuery . $nome. ' LIKE "'. '%'.$valor.'%'. '" AND ';                  
                if ($nome == "date_inicial") 
                        $prepareQuery = $prepareQuery . 'date'. '>="'. $valor. '" AND ';
                if ($nome == "date_final")
                        $prepareQuery = $prepareQuery . 'date'. '<="'. $valor. '" AND ';
            }
         }
   
         $query = substr($prepareQuery, 0 , -5);

    

        if ($query == False){
            $cotacoes = Price_ceasa_bh::get();
         
            return view('plantetc.import.ceasaBH.ceasa_research.index', compact('cotacoes'));    
        }

        $cotacoes = Price_ceasa_bh::whereRaw($query)->orderBy('date')->get();
     //   $cotacoes_csv = $cotacoes->toArray();
    
     $cotacoes_csv = $cotacoes;
    
     // Gerando arquivo CSV

       $stream = fopen(__DIR__."/csvs/cotacoes.csv","w");

     $csv= Writer::createFromStream($stream);

       $csv->insertOne([
        'date',
        'product',
        'embalagem',
        'price_min',
        'price_com',
        'price_max',
        'situation'
       ]);


        foreach($cotacoes_csv as $cotacao){
            $csv->insertOne([
                $cotacao->date,
                $cotacao->product,
                $cotacao->embalagem,
                $cotacao->price_min,
                $cotacao->price_com,
                $cotacao->price_max,
                $cotacao->situation
            ]);
        }

          
    return view('plantetc.import.ceasaBH.ceasa_research.index', compact('cotacoes'));
    } 
}
