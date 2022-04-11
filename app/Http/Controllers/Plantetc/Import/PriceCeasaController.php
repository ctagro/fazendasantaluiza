<?php

namespace App\Http\Controllers\Plantetc\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Models\Price_ceasa_bh;
use App\Http\Requests\ImportRequest;
use App\Import\PriceCeasaImport;
use Illuminate\Support\Facades\Schema;
use App\Report\CustomerReport;
use Exception;
use Illuminate\Database\SchemaBuilder;
Use League\Csv\Reader;
Use League\Csv\Writer;
Use League\Csv\Statement;

class PriceCeasaController extends Controller
{
    protected $priceCeasa_import; 

    public function __construct(
                                PriceCeasaImport $priceCeasa_import
                                )
    {
       
        $this->priceCeasa_import = $priceCeasa_import;

    }

    public function import()
    {
        return view('plantetc.import.ceasaBH.form');
    }


    public function storeImport(Request $request)
    {
        // Criar deste de consistência de leitura do arquivo

        $date = $request['date'];

        $date_exist = Price_ceasa_bh::where('date', '=', $date)->get()->count();
     

        if( $date_exist > 0){
        
            return redirect()
                        ->route('ceasa.import')
                        ->with('erro', 'Esta data já foi importada!!! Verifique a data dos dados que quer baixar...');
        }
       
        $response = $this->priceCeasa_import->allData($request);

        $cotacoes = Price_ceasa_bh::where('date', '=', $date)->orderBy('date')->get();           
       
        //dd($cotacoes);

        
      //  return redirect()->route('ceasa.index',[$date]);  
    return view('plantetc.import.ceasaBH.index',compact('cotacoes')); 
    }

    public function index($date)
    {
        

    //   dd($date);
    
        $cotacoes = Price_ceasa_bh::whereRaw('date = $date')->orderBy('date')->get();           
       
      //   dd($cotacoes);
       

        return view('plantetc.import.ceasaBH.index',compact('cotacoes'));
    }

    public function edit($import) {



        return view('plantetc.import.ceasaBH.edit',['import' => $import]);
    }
}
