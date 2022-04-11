<?php

namespace App\Import;

use App\Models\Price_ceasa_bh;
//use App\Tools\Sanitize;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
Use League\Csv\Reader;
use League\Csv\Writer;
Use League\Csv\Statement;
// use PhpOffice\PhpSpreadsheet\IOFactory;

class PriceCeasaImport
{
    protected $Price_ceasa_bh;
   // protected $sanatize;

   public function __construct(Price_ceasa_bh $price_ceasa_bh)
    {
        $this->price_ceasa_bh = $price_ceasa_bh;
   //     $this->sanatize = $sanatize;
   }

    public function allData(Request $request)
    {
     // dd($request);

      $data = $request;
        $file = $data['file'];
        $date = $data['date'];
     // dd($date);
    
        $stream = fopen($file, 'r');
      

    //    $stream = fopen('../App/Http/Controllers/Import/boletim_grupo.csv', 'r');
        //$csv = Reader::createFromStream('../App/Http/Controllers/Import/boletim_grupo.csv', 'r');
        $csv = Reader::createFromStream($stream);

        $csv->setDelimiter(";");
        $stmt = (new Statement());
        $precos = $stmt->process($csv);

     
        $line=0;
        $data = [];
        foreach($precos as $item){
                   
            //$tt = floatval($item[2]);
            $item[2] = floatval(str_replace(',', '.', str_replace('.', '', $item[2])));
            $item[3] = floatval(str_replace(',', '.', str_replace('.', '', $item[3])));
            $item[4] = floatval(str_replace(',', '.', str_replace('.', '', $item[4])));
           
                        
            $data['date']      = $date;
            $data['product']   = $item[0];
            $data['embalagem'] = $item[1];
            $data['price_min'] = $item[2];
            $data['price_com'] = $item[3];
            $data['price_max'] = $item[4];
            $data['situation'] = $item[5];

            
            $Price_ceasa_bh = new Price_ceasa_bh();

                     

            // Chamando a objeto a funcao do model despesa e passando o array 
            // capiturado no formulario da view productiro/despesa
                
            $response = $Price_ceasa_bh->storePriceCeasa($data);
                
                    
                }
                                   
                return redirect()
                ->back()
                ->with('error',  'Falha ao cadastrar o funcionário');

            }    
        }