<?php

namespace App\Models\Auxiliaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Control extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'description' ,
        'note',
        'in_use'
    
];

public function storecontrol(array $data): Array
    {

        //dd($data);

            $control = auth()->user()->Control ()->create([         
                
            
                'name'              => $data['name'],
                'description'        => $data['description'],
                'note'              => $data['note'],
                'in_use'            => $data['in_use']

            ]);

 
       if($control){

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
