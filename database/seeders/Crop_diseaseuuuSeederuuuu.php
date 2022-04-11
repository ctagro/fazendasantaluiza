<?php

namespace Database\Seeders;
use App\Models\Crop_disease;

use Illuminate\Database\Seeder;

class Crop_diseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
            Crop_disease::create([
                        
                'crop_id'    => 1,
                'disease_id' => 2,
            ]);
    
            Crop_disease::create([
                                
                        'crop_id' => 1,
                        'disease_id' => 3,
                    ]);
            
            Crop_disease::create([
                                
                        'crop_id' => 1,
                        'disease_id' => 4
                    ]);
            
            Crop_disease::create([
                                
                        'crop_id' => 2,
                        'disease_id' => 4
                    ]);
            Crop_disease::create([
                                
                        'crop_id' => 2,
                        'disease_id' => 5
                    ]);
            Crop_disease::create([
                                
                        'crop_id' => 2,
                        'disease_id' => 6
                    ]);
   
    }
}
