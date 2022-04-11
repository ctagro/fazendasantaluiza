<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Import\PriceCeasaImport;
use Carbon\Carbon;
use DateTime;
use DB;

class Price_ceasa_bh extends Model
{

    protected $fillable = [
        'date',
        'product',
        'embalagem',
        'price_min',
        'price_com',
        'price_max',
        'situation',
    ];


public function getDateAttribute($value)
{
    return Carbon::parse($value)->format('d/m/Y');
}

public function storePriceCeasa(array $data): Array
{  
  
    //dd($data);

       $priceCeasa = Price_ceasa_bh::create([

                'date'          =>      $data['date'],       
                'product'       =>      $data['product'],    
                'embalagem'     =>      $data['embalagem'],  
                'price_min'     =>      $data['price_min'],  
                'price_com'     =>      $data['price_com'],  
                'price_max'     =>      $data['price_max'],  
                'situation'     =>      $data['situation'],         
           
                ]);

                if($priceCeasa){

                    DB::commit();
        
                    return[
                        'sucess' => true,
                        'mensage'=> 'Preços registrados com sucesso'
                    ];
        
                    }
        
               else {
        
                    DB::rollback();
        
                    return[
                            'sucess' => false,
                            'mensage'=> 'Falha ao registrar os preços'
                    ];
                    }
        
  }
}
