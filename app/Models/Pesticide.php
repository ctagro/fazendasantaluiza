<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Crop;
use App\Models\Disease;

class Pesticide extends Model
{
    // use HasFactory;

    public function crops()
        {
            return $this->belongsToMany(Crop::class);
        }

    public function diseases()
        {
            return $this->belongsToMany(Disease::class);
        }
    
}
