<?php

namespace App\Models\Auxiliaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChemicalGroup extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'description' ,
        'note',
        'in_use'
    
];

public function storechemicalGroup(array $data): Array
    {

        //dd($data);

            $chemicalGroup = auth()->user()->ChemicalGroup()->create([         
                
            
                'name'              => $data['name'],
                'description'        => $data['description'],
                'note'              => $data['note'],
                'in_use'            => $data['in_use']

            ]);

 
       if($chemicalGroup){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Tipo de Grupo Químico registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar do Grupo Químico'
            ];
            }

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
