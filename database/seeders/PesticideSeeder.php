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
                        
            'name'          => 'Defensivo 1',
           
        ]);

        Pesticide::create([
                        
            'name'          => 'Defensivo 2',
           
        ]);

        Pesticide::create([
                        
    
            'name'          => 'Defensivo 3',
           
        ]);

        Pesticide::create([
                        
            'name'          => 'Defensivo 4',
           
        ]);

        Pesticide::create([
                        
            'name'          => 'Defensivo 5',
           
        ]);
       
          
        Pesticide::create([
                        
            'name'          => 'Defensivo 6',
           
        ]);
        
    }
}
