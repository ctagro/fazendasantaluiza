<?php

namespace Database\Seeders;

use App\Models\Crop;
use Illuminate\Database\Seeder;

class CropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        Crop::create([

            'user_id'           => 1,            
            'name'              => 'Tomate',
            'scientific_name'   => 'Solanum lycopersicum',
            'description'       => 'O tomate é o fruto[1] do tomateiro (Solanum lycopersicum; Solanaceae).',
            'note'              => 'As espécies são originárias das Américas Central e do Sul; 
                                    sua utilização como alimentos teve origem no México,[3] espalhando-se 
                                    por todo o mundo depois da colonização das Américas pelos europeus.',
            'in_use'            => 'S',
           
        ]);

        Crop::create([
                 
            'user_id'           => 1,
            'name'              => 'Pimentão',
            'scientific_name'   => 'Capsicum annuum Group',
            'description'       => 'Pimentão (português brasileiro) ou pimento (português europeu) refere-se a um grupo de cultivares.',
            'note'              => 'Os vários cultivares produzem frutos com diferentes cores sendo as mais conhecidas o verde, o amarelo
                                     e o vermelho. 
                                     Porém, existem outras variedades bastante exóticas, como o branco, roxo, azulado, preto e laranja.[1] São plantas nativas do México, América Central e do norte da América do Sul.',
            'in_use'            => 'S',
           
        ]);

    }
    
}
