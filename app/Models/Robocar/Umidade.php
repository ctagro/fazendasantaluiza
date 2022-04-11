<?php

namespace App\Models\Robocar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Umidade extends Model
{
    protected $fillable = [
        'valor',
    
];

public function storeUmidade(array $data): Array
    {

        $umidade = Umidade::create([
            'valor'=> $data['valor'],
        ]);

 
       if($umidade){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Valor de umidade registrado com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar valor da umidade'
            ];
            }

    }

}
