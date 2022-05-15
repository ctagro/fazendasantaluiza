<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliaries\ModeOperation;

class ModeOperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        ModeOperation ::create([
                        
            'user_id'       => 1,
            'name'          => 'Contato e Ingestão', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

        ModeOperation ::create([

            'user_id'       => 1,
            'name'          => 'Ingestão', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

        ModeOperation ::create([
                        
            'user_id'       => 1,
            'name'          => 'Sistêmico e de contato', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);
    }
}
