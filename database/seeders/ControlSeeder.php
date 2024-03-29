<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliaries\Control;

class ControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Control ::create([
                        
            'user_id'       => 1,
            'name'          => 'Contato', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);
        Control ::create([
                        
            'user_id'       => 1,
            'name'          => 'Sistemico', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

        Control ::create([
                        
            'user_id'       => 1,
            'name'          => 'Outro', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);
    }
}
