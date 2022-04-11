<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliaries\Crop_variety;

class CropVarietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Crop_variety::create([
                        
            'user_id'       => 1,
            'name'          => 'Tomate italiano', 
            'crop_id'       => 1,
            'description'   => 'Tomate italiano',  
            'in_use'        => 'S', 
            'image'         => 'Tomate italiano',  
            'note'          => 'Tomate italiano',
          
        ]);

        Crop_variety::create([
                       
            'user_id'       => 1,
            'name'          => 'Tomate grape', 
            'crop_id'       => 1,
            'description'   => 'Tomate grape',  
            'in_use'        => 'S', 
            'image'         => '',  
            'note'          => 'Tomate grape',
           
        ]);


        Crop_variety::create([

            'user_id'       => 1,      
            'name'          => 'Tomate cereja', 
            'crop_id'       => 1,
            'description'   => 'Tomate cereja',  
            'in_use'        => 'S', 
            'image'         => '',  
            'note'          => 'Tomate cereja'
      
       ]);

       Crop_variety::create([

            'user_id'       => 1,
            'name'          => 'Tomate cereja', 
            'crop_id'       => 1,
            'description'   => 'Tomate cereja',  
            'in_use'        => 'S', 
            'image'         => '',  
            'note'          => 'Tomate cereja',
      
       ]);

       Crop_variety::create([
                       
           
            'user_id'       => 1,
            'name'          => 'Pimentão Amarelo', 
           'crop_id'       => 2,
           'description'   => 'Pimentão Amarelo',  
           'in_use'        => 'S', 
           'image'         => '',  
           'note'          => 'Pimentão Amarelo',
      
       ]);

       Crop_variety::create([
                 
            'user_id'       => 1,    
            'name'          => 'Pimentão Vermelho', 
            'crop_id'       => 2,
            'description'   => 'Pimentão Vermelho',  
            'in_use'        => 'S', 
            'image'         => '',  
            'note'          => 'Pimentão Vermelho',
   
    ]);

        Crop_variety::create([

            'user_id'       => 1,                       
            'name'          => 'Pimentão Verde', 
            'crop_id'       => 2,
            'description'   => 'Pimentão Verde',  
            'in_use'        => 'S', 
            'image'         => '',  
            'note'          => 'Pimentão Verde',

]); 

    }
}
