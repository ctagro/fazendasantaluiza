<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliaries\ActionSite;

class ActionSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActionSite ::create([
                        
            'user_id'       => 1,
            'name'          => 'Sistema nervoso e Muscular', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

        ActionSite ::create([
                        
            'user_id'       => 1,
            'name'          => 'Crescimento e Desenvolvimento', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);

        ActionSite ::create([
                        
            'user_id'       => 1,
            'name'          => 'Respiração Celular', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);
    }
}
