<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Auxiliaries\Crop_variety;
use App\Models\Pesticide;
use App\Models\Crop;
use App\Models\ActivePrinciple;
use App\Models\Auxiliaries\AgronomicClass;
use App\Models\Auxiliaries\FormulationType;
use App\Models\Auxiliaries\Manufacturer;
use App\Models\Auxiliaries\ApplicationMode;
use App\Models\Auxiliaries\ChemicalGroup;
use App\Models\Auxiliaries\ToxicologicalClass;
use App\Models\Auxiliaries\ActionSite;
use App\Models\Auxiliaries\ModeOperation;
use App\Models\Auxiliaries\ActuationMechanism;
use App\Models\Auxiliaries\Grupo_quimico;
use App\Models\Auxiliaries\Control;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'password',
    ];

   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function crop_variety()
    {
        return $this->hasMany(Crop_variety::class);
    }

    public function active_principles()
    {
        return $this->hasMany(ActivePrinciple::class);
    }

    public function pesticide()
    {
        return $this->hasMany(Pesticide::class);
    }

    public function crop()
    {
        return $this->hasMany(Crop::class);
    }

    public function agronomicClass()
    {
        return $this->hasMany(AgronomicClass::class);
    }

    public function formulationType()
    {
        return $this->hasMany(FormulationType::class);
    }

    public function manufacturer()
    {
        return $this->hasMany(Manufacturer::class);
    }

    public function applicationMode()
    {
        return $this->hasMany(ApplicationMode::class);
    }

    public function chemicalGroup()
    {
        return $this->hasMany(ChemicalGroup::class);
    }

    public function toxicologicalClass()
    {
        return $this->hasMany(ToxicologicalClass::class);
    }

    public function actionSite()
    {
        return $this->hasMany(ActionSite::class);
    }

    public function modeOperation()
    {
        return $this->hasMany(ModeOperation::class);
    }

    public function actuationMechanism()
    {
        return $this->hasMany(ActuationMechanism::class);
    }

    public function grupo_quimico()
    {
        return $this->hasMany(Grupo_quimico::class);
    }

    public function control()
    {
        return $this->hasMany(Control::class);
    }




}
