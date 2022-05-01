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
            'name'                  => 'Dicarzol1',
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
            'actuationMechanism_id' => 1,
            'applicationRange'      => 1,
            'numberApplications'    => 1,
            'note'                  => 1,
            'image'                 => 'foto1',
            'in_use'                => 'S',
           
        ]);

        Pesticide::create([
                        
            'user_id'               => 1,
            'name'                  => 'Fastac1',
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
            'actuationMechanism_id' => 1,
            'applicationRange'      => 1,
            'numberApplications'    => 1,
            'note'                  => 1,
            'image'                 => 'foto1',
            'in_use'                => 'S',
           
        ]);

        Pesticide::create([
                        
            'user_id'               => 1,
            'name'                  => 'Oberom1',
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
            'actuationMechanism_id' => 1,
            'applicationRange'      => 1,
            'numberApplications'    => 1,
            'note'                  => 1,
            'image'                 => 'foto1',
            'in_use'                => 'S',
           
        ]);

        Pesticide::create([
                        
            'user_id'               => 1,
            'name'                  => 'Pirate1',
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
            'actuationMechanism_id' => 1,
            'applicationRange'      => 1,
            'numberApplications'    => 1,
            'note'                  => 1,
            'image'                 => 'foto1',
            'in_use'                => 'S',
           
        ]);
    }

}
