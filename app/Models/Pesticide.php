<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use App\Models\Crop;
Use App\Models\ActivePrinciple;
Use App\Models\Disease;

class Pesticide extends Model
{
    //use HasFactory;
    protected $fillable = [
   
        'user_id',
        'name',
        'manufacturer_id',
        'agronomicClass_id',
        'formulationType_id',
        'dosage',
        'unity',
        'applicationMode_id',
        'toxicologicalClass_id',
        'chemicalGroup_id',
        'actionSite_id',
        'modeOperation_id',
        'actuationMechanism_id',
        'applicationRange',
        'numberApplications',
        'note',
        'image',
        'in_use'
    
    ];
    
    /*********************************
     * Formatando a data como dia mes e ano
     ******************************/
    
    public function storePesticide(array $data): Array
    {  
       //dd($data);
    
            $pesticide = Pesticide::create([

                'user_id'               => $data['user_id'],
                'name'                  => $data['name'],
                'manufacturer_id'       => $data['manufacturer_id'],
                'agronomicClass_id'     => $data['agronomicClass_id'],
                'formulationType_id'    => $data['formulationType_id'],
                'dosage'                => $data['dosage'],
                'unity'                 => $data['unity'],
                'applicationMode_id'    => $data['applicationMode_id'],
                'toxicologicalClass_id' => $data['toxicologicalClass_id'],
                'chemicalGroup_id'      => $data['chemicalGroup_id'],
                'actionSite_id'         => $data['actionSite_id'],
                'modeOperation_id'      => $data['modeOperation_id'],
                'actuationMechanism_id' => $data[ 'actuationMechanism_id'],
                'applicationRange'      => $data['applicationRange'],
                'numberApplications'    => $data['numberApplications'],
                'note'                  => $data['note'],
                'image'                 => $data['image'],
                'in_use'                => $data['in_use'],

             ]);
    
        $new_pesticide = $pesticide->id;
    
       if($pesticide){
    
            DB::commit();
    
            return[
                'sucess' => true,
                'mensage'=> 'Defensivo registrada com sucesso',
                'new_pesticide' => $new_pesticide
            ];
    
            }
    
       else {
    
            DB::rollback();
    
            return[
                    'sucess' => false,
                    'mensage'=> 'Falha ao registrar o defensivo'
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

    public function diseases()
        {
            return $this->belongsToMany(Disease::class);
        }

        public function active_principles()
        {
            return $this->belongsToMany(ActivePrinciple::class);
        }

        public static function boot() {
            parent::boot();
            self::deleting(function($pesticide) { // before delete() method call this
                 $pesticide->crops()->detach(); // <-- direct deletion
                 });
                 // do the rest of the cleanup...
        }

        public static function boot1() {
            parent::boot();
            self::deleting(function($pesticide) { // before delete() method call this
                 $pesticide->diseases()->detach(); // <-- direct deletion
                 });
                 // do the rest of the cleanup...
        }

        public static function boot2() {
            parent::boot();
            self::deleting(function($pesticide) { // before delete() method call this
                 $pesticide->active_principles()->detach(); // <-- direct deletion
                 });
                 // do the rest of the cleanup...
        }
    
}
