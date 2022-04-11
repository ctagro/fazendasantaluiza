<?php

namespace App\Models\Auxiliaries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DB;
use App\User;
Use App\Models\Crop;

use Illuminate\Database\Eloquent\SoftDeletes;

class Crop_variety extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'name',
        'crop_id',
        'description',  
        'in_use' , 
        'image',  
        'note'

    ];

   /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    public function getDateAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }

public function storeCrop_Variety(array $data): Array
    {  
      // dd($data);

            $crop_variety = auth()->user()->crop_variety()->create([

                'name'              => $data['name'],
                'crop_id'           => $data['crop_id'],
                'description'       => $data['description'], 
                'in_use'            => $data['in_use'],
                'image'             => $data['image'],
                'note'              => $data['note'],
                
             ]);

        
 
       if($crop_variety){

            DB::commit();

            return[
                'sucess' => true,
                'mensage'=> 'Cultura registrada com sucesso'
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


    
    public function crop()
   {
       return $this->belongsTo(crop::class);
   }

}
