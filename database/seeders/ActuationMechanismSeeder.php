<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliaries\ActuationMechanism;


class ActuationMechanismSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       ActuationMechanism ::create([
                        
            'user_id'       => 1,
            'name'          => '1A - Inibidor da Acetilcolinesterase', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

       ActuationMechanism ::create([
                        
            'user_id'       => 1,
            'name'          => '13 - Desacoplador da fosforilação oxidativa via disrupção do gradiente de próton', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);

       ActuationMechanism ::create([
                        
            'user_id'       => 1,
            'name'          => 'C3 - Complexo III: citocromo bc1 (ubiquinol oxidase) no sítio Qo, QoI-fungicidas (Inibidores extracelulares de Quinona)', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);
    }
}
