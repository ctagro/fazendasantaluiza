<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Disease;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Disease::create([
                        
            'user_id'           => 1,            
            'name'              => 'Oidio',
            'scientific_name'   => 'Oidium',
            'description'       => 'Oídio é o nome genérico dado a um numeroso conjunto de espécies de fungos unicelulares pertencentes à família dos Erysiphacea. ',
            'symptoms'          => 'Oidium',
            'control'           => 'Oidium',
            'note'              => 'As espécies são originárias das Américas Central e do Sul; 
                                    sua utilização como alimentos teve origem no México,[3] espalhando-se 
                                    por todo o mundo depois da colonização das Américas pelos europeus.',
            'in_use'            => 'S',
           
        ]);

        Disease::create([
                        
            'user_id'           => 1,            
            'name'              => 'Mosca Branca',
            'scientific_name'   => 'Bemisia tabaci',
            'description'       => 'A mosca-branca é uma das várias espécies de mosca-branca que atualmente são importantes pragas agrícolas.',
            'symptoms'          => 'Mosca Branca',
            'control'           => 'Mosca Branca',
            'note'              => 'As espécies são originárias das Américas Central e do Sul; 
                                    sua utilização como alimentos teve origem no México,[3] espalhando-se 
                                    por todo o mundo depois da colonização das Américas pelos europeus.',
            'in_use'            => 'S',
           
        ]);

                        
            Disease::create([
                        
                'user_id'           => 1,            
                'name'              => 'Ácaro Branco',
                'scientific_name'   => 'Polyphagotarsonemus latus',
                'description'       => 'O ácaro largo, Polyphagotarsonemus latus',
                'symptoms'          => 'Ácaro Branco',
                'control'           => 'Ácaro Branco',
                'note'              => 'O ácaro largo, Polyphagotarsonemus latus, é uma espécie microscópica de ácaro encontrada em muitas espécies de plantas, incluindo espécies agrícolas importantes, como uvas, maçãs e outras frutas. ',
                'in_use'            => 'S',
           
        ]);

        Disease::create([
                        
            'user_id'           => 1,            
            'name'              => 'Tripes',
            'scientific_name'   => 'Thysanoptera',
            'description'       => 'A mosca-branca é uma das várias espécies de mosca-branca que atualmente são importantes pragas agrícolas.Os insetos da ordem Thysanoptera são popularmente conhecidos como tripes, que significa “verme da madeira”, ',
            'symptoms'          => 'Tripes',
            'control'           => 'Tripes',
            'note'              => 'Os insetos da ordem Thysanoptera são popularmente conhecidos como tripes, que significa “verme da madeira”,  ',
            'in_use'            => 'S',
           
        ]);

    }
}
