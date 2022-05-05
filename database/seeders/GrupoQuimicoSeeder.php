<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliaries\Grupo_quimico;


class GrupoQuimicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grupo_quimico::create([
                        
            'user_id'       => 1,
            'name'          => 'Metilcarbamato de Felina', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

        Grupo_quimico::create([
                        
            'user_id'       => 1,
            'name'          => 'Cetoenol', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);

        Grupo_quimico::create([
                        
            'user_id'       => 1,
            'name'          => 'Cetoenol 1', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);
    }
}
