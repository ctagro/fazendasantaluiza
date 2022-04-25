<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliaries\ApplicationMode;

class ApplicationModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApplicationMode ::create([
                        
            'user_id'       => 1,
            'name'          => 'Foliar', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

        ApplicationMode ::create([
                        
            'user_id'       => 1,
            'name'          => 'Sistémico', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);

        ApplicationMode ::create([
                        
            'user_id'       => 1,
            'name'          => 'Na terra', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);
    }
}
