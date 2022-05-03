<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use App\Models\Crop;
Use App\Models\ActivePrinciple;
Use App\Models\Disease;

use App\Models\Auxiliaries\AgronomicClass;
use App\Models\Auxiliaries\FormulationType;
use App\Models\Auxiliaries\Manufacturer;
use App\Models\Auxiliaries\ApplicationMode;
use App\Models\Auxiliaries\ChemicalGroup;
use App\Models\Auxiliaries\ToxicologicalClass;
use App\Models\Auxiliaries\ActionSite;
use App\Models\Auxiliaries\ModeOperation;
use App\Models\Auxiliaries\ActuationMechanism;

class Defensivo extends Model
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
    
    public function storeDefensivo(array $data): Array
    {  
       //dd($data);
    
            $defensivo = Defensivo::create([

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
                'actuationMechanism_id' => $data['actuationMechanism_id'],
                'applicationRange'      => $data['applicationRange'],
                'numberApplications'    => $data['numberApplications'],
                'note'                  => $data['note'],
                'image'                 => $data['image'],
                'in_use'                => $data['in_use'],

             ]);
    
        $new_defensivo = $defensivo->id;
    
       if($defensivo){
    
            DB::commit();
    
            return[
                'sucess' => true,
                'mensage'=> 'Defensivo registrada com sucesso',
                'new_defensivo' => $new_defensivo
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
            self::deleting(function($defensivo) { // before delete() method call this
                 $defensivo->crops()->detach(); // <-- direct deletion
                 });
                 // do the rest of the cleanup...
        }

        public static function boot1() {
            parent::boot();
            self::deleting(function($defensivo) { // before delete() method call this
                 $defensivo->diseases()->detach(); // <-- direct deletion
                 });
                 // do the rest of the cleanup...
        }

        public static function boot2() {
            parent::boot();
            self::deleting(function($defensivo) { // before delete() method call this
                 $defensivo->active_principles()->detach(); // <-- direct deletion
                 });
                 // do the rest of the cleanup...
        }

        public function agronomicClass()
        {
            return $this->belongsTo(AgronomicClass::class,'agronomicClass_id');
        }
    
        public function formulationType()
        {
            return $this->belongsTo(FormulationType::class,'formulationType_id');
        }
    
        public function manufacturer()
        {
            return $this->belongsTo(Manufacturer::class,'manufacturer_id');
        }

        public function applicationMode()
        {
            return $this->belongsTo(ApplicationMode::class,'applicationMode_id');
        }
    
        public function toxicologicalClass()
        {
            return $this->belongsTo(ToxicologicalClass::class,'toxicologicalClass_id');
        }
    
        public function actionSite()
        {
            return $this->belongsTo(ActionSite::class,'actionSite_id');
        }
    
        public function modeOperation() 
        {
            return $this->belongsTo(ModeOperation::class,'modeOperation_id');
        }
    
        public function actuationMechanism()
        {
            return $this->belongsTo(ActuationMechanism::class,'actuationMechanism_id');
        }

        public function chemicalGroup()
        {
            return $this->belongsTo(ChemicalGroup::class,'chemicalGroup_id');
        }
    
    
}
