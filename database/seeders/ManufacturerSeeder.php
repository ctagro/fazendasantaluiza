<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliaries\Manufacturer;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manufacturer ::create([
                        
            'user_id'       => 1,
            'name'          => 'Bayer', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

        Manufacturer ::create([
                        
            'user_id'       => 1,
            'name'          => 'Bayer1', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);

        Manufacturer ::create([
                        
            'user_id'       => 1,
            'name'          => 'Bayer2)', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);
    }
}
