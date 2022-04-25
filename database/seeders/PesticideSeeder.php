<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesticide;

class PesticideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        Pesticide::create([

            'user_id'               => 1,
            'name'                  => 'Dicarzol',
            'manufacturer_id'       => 1,
            'agronomicClass_id'     => 1,
            'formulationType_id'    => 1,
            'dosage'                => 100,
            'unity'                 => 'ml',
            'applicationMode_id'    => 1,
            'toxicologicalClass_id' => 1,
            'chemicalGroup_id'      => 1,
            'actionSite_id'         => 1,
            'modeOperation_id'      => 1,
            'actuationMechanism'    => '3A - Modulador dos canais neurais de Sódio',
            'applicationRange'      => 1,
            'numberApplications'    => 1,
            'note'                  => 1,
            'image'                 => 'foto1',
            'in_use'                => 'S',
           
        ]);

        Pesticide::create([
                        
            'user_id'               => 1,
            'name'                  => 'Fastac',
            'manufacturer_id'       => 1,
            'agronomicClass_id'     => 1,
            'formulationType_id'    => 1,
            'dosage'                => 100,
            'unity'                 => 'ml',
            'applicationMode_id'    => 1,
            'toxicologicalClass_id' => 1,
            'chemicalGroup_id'      => 1,
            'actionSite_id'         => 1,
            'modeOperation_id'      => 1,
            'actuationMechanism'    => '3A - Modulador dos canais neurais de Sódio',
            'applicationRange'      => 1,
            'numberApplications'    => 1,
            'note'                  => 1,
            'image'                 => 'foto1',
            'in_use'                => 'S',
           
        ]);

        Pesticide::create([
                        
            'user_id'               => 1,
            'name'                  => 'Oberom',
            'manufacturer_id'       => 1,
            'agronomicClass_id'     => 1,
            'formulationType_id'    => 1,
            'dosage'                => 100,
            'unity'                 => 'ml',
            'applicationMode_id'    => 1,
            'toxicologicalClass_id' => 1,
            'chemicalGroup_id'      => 1,
            'actionSite_id'         => 1,
            'modeOperation_id'      => 1,
            'actuationMechanism'    => '3A - Modulador dos canais neurais de Sódio',
            'applicationRange'      => 1,
            'numberApplications'    => 1,
            'note'                  => 1,
            'image'                 => 'foto1',
            'in_use'                => 'S',
           
        ]);

        Pesticide::create([
                        
            'user_id'               => 1,
            'name'                  => 'Pirate',
            'manufacturer_id'       => 1,
            'agronomicClass_id'     => 1,
            'formulationType_id'    => 1,
            'dosage'                => 100,
            'unity'                 => 'ml',
            'applicationMode_id'    => 1,
            'toxicologicalClass_id' => 1,
            'chemicalGroup_id'      => 1,
            'actionSite_id'         => 1,
            'modeOperation_id'      => 1,
            'actuationMechanism'    => '3A - Modulador dos canais neurais de Sódio',
            'applicationRange'      => 1,
            'numberApplications'    => 1,
            'note'                  => 1,
            'image'                 => 'foto1',
            'in_use'                => 'S',
           
        ]);
    }

}
