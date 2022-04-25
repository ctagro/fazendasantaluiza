<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliaries\ToxicologicalClass;

class ToxicologicalClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ToxicologicalClass ::create([
                        
            'user_id'       => 1,
            'name'          => 'II - Altamente Tóxico', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

        ToxicologicalClass ::create([
                        
            'user_id'       => 1,
            'name'          => 'III - Medianamente Tóxico', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);

        ToxicologicalClass ::create([
                        
            'user_id'       => 1,
            'name'          => 'IV - Pouco Tóxico', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);
    
    }
}
