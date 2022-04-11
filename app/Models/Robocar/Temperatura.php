<?php

namespace App\Models\Robocar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;

class Temperatura extends Model
{
    
    protected $fillable = [
        'medidor',
        'valor',
        'location',

    
];

   /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    public function getDateAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }

public function storeTemperatura(array $data): Array
    {  
      

            $temperatura = Temperatura::create([

                        'medidor'          => $data['medidor'],
                        'valor'         => $data['valor'],
                        'location'      => $data['location'],

         ]);

        
 
       if($temperatura){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Tempratura registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar a Temperatura'
            ];
            }

    }


}
