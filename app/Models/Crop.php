<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\User;
use App\Models\Auxiliaries\Crop_variety;

use App\Models\Disease;
use App\Models\Pesticide;

class Crop extends Model
{
   // use HasFactory;
   protected $fillable = [
   
    'user_id',
    'name',
    'scientific_name',
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

public function storeCrop(array $data): Array
{  
   //dd($data);

        $crop = Crop::create([

            'user_id'           => $data['user_id'],
            'name'              => $data['name'],
            'scientific_name'   => $data['scientific_name'],
            'description'       => $data['description'],
            'note'              => $data['note'],
            'in_use'            => $data['in_use'],
            
         ]);

    $new_crop = $crop->id;

   if($crop){

        DB::commit();

        return[
            'sucess' => true,
            'mensage'=> 'Cultura registrada com sucesso',
            'new_crop' => $new_crop
        ];

        }

   else {

        DB::rollback();

        return[
                'sucess' => false,
                'mensage'=> 'Falha ao registrar a Cultura'
        ];
        }

}
     public function user()
        {
            return $this->belongsTo(User::class);
        }

   public function diseases()
        {
            return $this->belongsToMany(Disease::class);
        }

    public function pesticides()
        {
            return $this->belongsToMany(Pesticide::class);
        }

        public static function boot() {
            parent::boot();
            self::deleting(function($crop) { // before delete() method call this
                 $crop->diseases()->detach(); // <-- direct deletion
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
