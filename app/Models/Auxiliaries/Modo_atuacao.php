<?php

namespace App\Models\Auxiliaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modo_atuacao extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'description' ,
        'note',
        'in_use'
    
];

public function storemodo_atuacao(array $data): Array
    {

        //dd($data);

            $modo_atuacao = auth()->user()->Modo_atuacao ()->create([         
                
            
                'name'              => $data['name'],
                'description'        => $data['description'],
                'note'              => $data['note'],
                'in_use'            => $data['in_use']

            ]);

 
       if($modo_atuacao){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Tipo de Modo de Atuação registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar do Modo de Atuação'
            ];
            }

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
