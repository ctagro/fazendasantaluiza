<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliaries\ControlType;

class ControlTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ControlType ::create([
                        
            'user_id'       => 1,
            'name'          => 'Contato', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);
        ControlType ::create([
                        
            'user_id'       => 1,
            'name'          => 'Sistemico', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

        ControlType ::create([
                        
            'user_id'       => 1,
            'name'          => 'Outro', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);
    
    }
}
