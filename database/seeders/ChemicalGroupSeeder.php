<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliaries\ChemicalGroup;

class ChemicalGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChemicalGroup ::create([
                        
            'user_id'       => 1,
            'name'          => 'Metilcarbamato de Felina', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

        ChemicalGroup ::create([
                        
            'user_id'       => 1,
            'name'          => 'Piretróide', 
            'description'   => '..',    
            'note'          => '..',
            'in_use'        => 'S'
          
        ]);

        ChemicalGroup ::create([
                        
            'user_id'       => 1,
            'name'          => 'Cetoenol', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);
    }
}
