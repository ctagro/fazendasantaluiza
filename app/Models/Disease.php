<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use DB;
use App\User;
use App\Models\Crop;
use App\Models\Pesticide;
use App\Models\ActivePrinciple;
use App\Models\Auxiliaries\ControlType;




class Disease extends Model
{
    //use HasFactory;
    protected $fillable = [
   
        'user_id',
        'name',
        'scientific_name',
        'description',
        'symptoms',
        'controlType_id',
        'control',
        'note',
        'in_use'
    
    ];
    
    /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
     
    
    public function getDateAttribute($value)
     {
         return Carbon::parse($value)->format('d/m/Y');
     }
    
    public function storeDisease(array $data): Array
    {  
       //dd($data);
    
            $disease = Disease::create([
    
                'user_id'           => $data['user_id'],
                'name'              => $data['name'],
                'scientific_name'   => $data['scientific_name'],
                'description'       => $data['description'],
                'symptoms'          => $data[ 'symptoms'],
                'controlType_id'    => $data[ 'controlType_id'],
                'control'           => $data[ 'control'],
                'note'              => $data['note'],
                'in_use'            => $data['in_use'],

             ]);
    
        $new_disease = $disease->id;
    
       if($disease){
    
            DB::commit();
    
            return[
                'sucess' => true,
                'mensage'=> 'Cultura registrada com sucesso',
                'new_disease' => $new_disease
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

    public function crops()
        {
            return $this->belongsToMany(Crop::class);
        }

    public function pesticides()
        {
            return $this->belongsToMany(Pesticide::class);
        }

    public function active_principles()
        {
            return $this->belongsToMany(ActivePrinciple::class);
        }


        public static function boot() {
            parent::boot();
            self::deleting(function($disease) { // before delete() method call this
                $disease->crops()->detach(); // <-- direct deletion
                });
            self::deleting(function($disease) { // before delete() method call this
                $disease->active_principles()->detach(); // <-- direct deletion
                });
            }  
                        
            public function controlType()
            {
                return $this->belongsTo(ControlType::class,'controlType_id');
            }
}
