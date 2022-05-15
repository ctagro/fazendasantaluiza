<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivePrinciple;

class ActivePrincipleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        ActivePrinciple::create([
                        
            'user_id'               => 1,            
            'name'                  => 'Cloridrato de formetanate',
            'agronomicClass_id'     => 1,
            'description'           => 'O tomate é o fruto[1] do tomateiro (Solanum lycopersicum; Solanaceae).',
            'note'                  => 'As espécies são originárias das Américas Central e do Sul; 
                                    sua utilização como alimentos teve origem no México,[3] espalhando-se 
                                    por todo o mundo depois da colonização das Américas pelos europeus.',
            'in_use'                => 'S',
           
        ]);

        ActivePrinciple::create([
                        
            'user_id'               => 1,            
            'name'                  => 'Alfa-cipermetrina',
            'agronomicClass_id'     => 1,
            'description'           => 'O tomate é o fruto[1] do tomateiro (Solanum lycopersicum; Solanaceae).',
            'note'                  => 'As espécies são originárias das Américas Central e do Sul; 
                                    sua utilização como alimentos teve origem no México,[3] espalhando-se 
                                    por todo o mundo depois da colonização das Américas pelos europeus.',
            'in_use'                => 'S',
           
        ]);

        ActivePrinciple::create([
                        
    
            'user_id'               => 1,            
            'name'                  => 'Espiromezifeno',
            'agronomicClass_id'     => 1,
            'description'           => 'O tomate é o fruto[1] do tomateiro (Solanum lycopersicum; Solanaceae).',
            'note'                  => 'As espécies são originárias das Américas Central e do Sul; 
                                    sua utilização como alimentos teve origem no México,[3] espalhando-se 
                                    por todo o mundo depois da colonização das Américas pelos europeus.',
            'in_use'                => 'S',
           
        ]);

        ActivePrinciple::create([
                        
            'user_id'               => 1,            
            'name'                  => 'Espiromezifeno',
            'agronomicClass_id'     => 1,
            'description'           => 'O tomate é o fruto[1] do tomateiro (Solanum lycopersicum; Solanaceae).',
            'note'                  => 'As espécies são originárias das Américas Central e do Sul; 
                                    sua utilização como alimentos teve origem no México,[3] espalhando-se 
                                    por todo o mundo depois da colonização das Américas pelos europeus.',
            'in_use'                => 'S',
           
        ]);
        
    }
}
