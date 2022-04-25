<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliaries\FormulationType;

class FormulationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FormulationType::create([
                        
            'user_id'       => 1,
            'name'          => 'Pó Molhável (WP)', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

        FormulationType::create([
                        
            'user_id'       => 1,
            'name'          => 'Concentrado Emulsionável (EC)', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);

        FormulationType::create([
                        
            'user_id'       => 1,
            'name'          => 'Suspensão concentrada (SC)', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);
    }
}
