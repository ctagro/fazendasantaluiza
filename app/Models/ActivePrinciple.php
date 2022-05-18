<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use DB;
use App\User;
use App\Models\Pesticide;
use App\Models\Auxiliaries\AgronomicClass;

class ActivePrinciple extends Model
{
    // use HasFactory;
   protected $fillable = [
   
    'user_id',
    'name',
    'agronomicClass_id',
    'description',
    'note',
    'in_use',

];

/*********************************
 * Formatando a data como dia mes e ano
 ******************************/
 

public function getDateAttribute($value)
 {
     return Carbon::parse($value)->format('d/m/Y');
 }

public function storeActivePrinciple(array $data): Array
{  
   //dd($data);

        $ActivePrinciple = ActivePrinciple::create([

            'user_id'           => $data['user_id'],
            'name'              => $data['name'],
            'agronomicClass_id' => $data['agronomicClass_id'],
            'description'       => $data['description'],
            'note'              => $data['note'],
            'in_use'            => $data['in_use'],
            
         ]);

    $new_ActivePrinciple = $ActivePrinciple->id;

   if($ActivePrinciple){

        DB::commit();

        return[
            'sucess' => true,
            'mensage'=> 'Princípio Ativo registrada com sucesso',
            'new_ActivePrinciple' => $new_ActivePrinciple
        ];

        }

   else {

        DB::rollback();

        return[
                'sucess' => false,
                'mensage'=> 'Falha ao registrar o Princípio Ativo'
        ];
        }

}
     public function user()
        {
            return $this->belongsTo(User::class);
        }

    public function agronomicClass()
        {
            return $this->belongsTo(AgronomicClass::class,'agronomicClass_id');
        }

    public function pesticides()
        {
            return $this->belongsToMany(Pesticide::class,  'active_principle_pesticide', 'active_principle_id', 'pesticide_id');
        }

        public static function boot() {
            parent::boot();
            self::deleting(function($ActivePrinciple) { // before delete() method call this
                 $ActivePrinciple->pesticides()->detach(); // <-- direct deletion
                 });
                 // do the rest of the cleanup...
        }
/*
        public function image()
        {
        return $this->belongsTo(image::class);
        }
*/        

}
