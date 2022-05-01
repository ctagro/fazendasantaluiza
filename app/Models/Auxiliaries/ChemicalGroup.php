<?php

namespace App\Models\Auxiliaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use App\User;
Use App\Models\Pesticide;
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

            $chemicalGroup = auth()->user()->ChemicalGroup ()->create([         
                
            
                'name'              => $data['name'],
                'description'        => $data['description'],
                'note'              => $data['note'],
                'in_use'            => $data['in_use']

            ]);

 
       if($chemicalGroup){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Classe Toxicológica registrada com sucesso'
            ];

            }

       else {

            DB::rollback();

            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar do Classe Toxicológica'
            ];
            }

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesticide()
    {
        return $this->belongsTo(Pesticide::class);
    }

  
 
}
