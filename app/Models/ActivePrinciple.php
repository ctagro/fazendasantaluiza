<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivePrinciple extends Model
{
    // use HasFactory;

    public function pesticides()
        {
            return $this->belongsToMany(Pesticide::class);
        }

}
