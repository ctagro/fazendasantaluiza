<?php

namespace App\Http\Controllers\Plantetc\Robocar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Models\Price_ceasa_bh;
use App\Models\Ceasa_product;
Use DB;
use App\Http\Requests\ImportRequest;
use App\Import\PriceCeasaImport;
use Illuminate\Support\Facades\Schema;
use App\Report\CustomerReport;
use Exception;
use Illuminate\Database\SchemaBuilder;

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
   

    $products = Ceasa_product::get();


    return view('plantetc.robocar.panel.index',compact('products'));


    }


    public function chart(Request $request)
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
            $products = Ceasa_product::get();
           // dd($cotacoes);
           // dd($cotacoes);
           return view('plantetc.robocar.panel.index',compact('products'));
        }

        $cotacoes = Price_ceasa_bh::whereRaw($query)->orderBy('date')->get();
          
     
     

        
    return view('plantetc.robocar.panel.chart', compact('cotacoes','last_cotacoes'));
    }
    
    public function chart1()

    {
        $x_datas = [];
        $y1_datas = [];
        $y2_datas = [];
        $y3_datas = [];

        // array necessários para criar de forma randomica
        // 1 - $dates => '01/11/2021','03/11/2021','05/11/2021','08/11/2021','10/11/2021','12/11/2021','17/11/2021','
        // 2 - $price_com => 7.22,16.66,16.66,15,14.44,10,7.77,7.77,7.77,6.66,6.66,6.66,6.66,6.66"
        // 3 - $price_max => 7.22,16.66,16.66,15,14.44,10,7.77,7.77,7.77,6.66,6.66,6.66,6.66,6.66"
        // 4 - $price_min => 7.22,16.66,16.66,15,14.44,10,7.77,7.77,7.77,6.66,6.66,6.66,6.66,6.66"
        $x_datas = ['1','2','3','4','5','6','7','8','9','10'];
        $y1_datas = [7.22,16.66,16.66,15,14.44,10,7.77,7.77,7.77,6.66];
        $y2_datas = [7.22,13.66,17.66,10,12.44,11,8.77,10,5.77,3.77];
        $y3_datas = [7.77,16.66,16.66,15.55,14.44,10,8.88,8.88,8.88,8.88];

        $dates = [];
        $prices_com = [];
        $prices_max = [];
        $prices_min = [];
  
    //    dd($x_dates);
  
        $dates = implode(",",$x_datas);
         $prices_com = implode(",",$y1_datas);
         $prices_max = implode(",",$y2_datas);
         $prices_min = implode(",",$y3_datas);
  
         $product = 'Produto';
         $unidade = "KG";

         $last_price_com = $y1_datas[9];
         $last_price_max = $y2_datas[9];
         $last_price_min = $y3_datas[9];

   //  dd('controller',$dates,$prices_com,$prices_max,$product,$prices_min,$y3_datas);

         return view('plantetc.robocar.panel.chart1', compact('dates','prices_com','prices_max','product',
         'prices_min','unidade','last_price_com','last_price_max','last_price_min'));
        /*
        array_shift($y1_datas);
        $y1_datas[] = rand(1,20);

        array_shift($y1_datas);
        $y1_datas[] = rand(1,20);


        dd($y1_datas);
*/
    //   dd($x_datas,$y1_datas,$y2_datas,$y3_datas);

    //    return view('plantetc.robocar.panel.chart1', compact('x_datas','y1_datas','y2_datas','y3_datas'));

    }


    public function last_date()

    {

        $products = Ceasa_product::whereRaw(max('date'))->get();

     //  dd($products);


    return view('plantetc.robocar.panel.research',compact('products'));

    }
}
