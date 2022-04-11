<?php

namespace App\Http\Controllers\Plantetc\Robocar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class PanelController extends Controller
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


        return view('plantetc.import.ceasaBH.ceasa_research.index');
    }

    public function consult()

    {

        $products = Ceasa_product::get();

       //dd($products);


    return view('plantetc.robocar.charts.research',compact('products'));

    }
    
    public function research(Request $request)
    {

        $last_date = DB::table('price_ceasa_bhs')->max('date');
        // $last_cotacao= Price_ceasa_bh::where('date', '=', $last_date)->get();
        $last_cotacoes= DB::table('price_ceasa_bhs')->where('date', '=', $last_date)->where('product', 'LIKE', 'PIMENTAO AMARELO')->get();
     //  dd($last_cotacoes);

       $pesquisa = $request;

       //dd($pesquisa['product']);

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
            return view('plantetc.import.ceasaBH.ceasa_research.index', compact('cotacoes','last_cotacoes'));    
        }

        $cotacoes = Price_ceasa_bh::whereRaw($query)->orderBy('date')->get();
          
     // dd($cotacoes);
     

        
    return view('plantetc.ceasa.charts.chart_product', compact('cotacoes','last_cotacoes'));
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


    public function last_date()

    {

        $products = Ceasa_product::whereRaw(max('date'))->get();

       dd($products);


    return view('plantetc.ceasa.charts.research',compact('products'));

    } 
}
