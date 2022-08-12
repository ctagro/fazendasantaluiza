<?php

namespace App\Models\Auxiliaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use App\User;

class ControlType extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'description' ,
        'note',
        'in_use'
    
];

public function storecontrolType(array $data): Array
    {

      //  dd($data);

            $controlType = auth()->user()->ControlType()->create([         
                
            
                'name'              => $data['name'],
                'description'       => $data['description'],
                'note'              => $data['note'],
                'in_use'            => $data['in_use']

            ]);

 
       if($controlType){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Tipo de Classe Agronomica registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar do Tipo de Formulação'
            ];
            }

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
