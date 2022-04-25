<?php

namespace Database\Seeders;

use App\Models\Auxiliaries\AgronomicClass;
use Illuminate\Database\Seeder;

class AgronomicClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AgronomicClass::create([
                        
            'user_id'       => 1,
            'name'          => 'Inseticida', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

        AgronomicClass::create([
                        
            'user_id'       => 1,
            'name'          => 'Fungicida', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);

        AgronomicClass::create([
                        
            'user_id'       => 1,
            'name'          => 'Acaricida', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);
    }
}
