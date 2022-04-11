<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ceasa_product;

class CeasaProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
         
        \App\Models\Ceasa_product::create([
                        
             
             'name'       => 'PIMENTAO AMARELO',
           
         ]);
 
         Ceasa_product::create([
                        
             
             'name'       => 'PIMENTAO VERMELHO',
            
         ]);
 

         Ceasa_product::create([
                        
            
            'name'       => 'PIMENTAO VERDE EXTRA A',
       
        ]);

        Ceasa_product::create([
                        
            
            'name'       => 'PIMENTAO VERDE EXTRA A',
       
        ]);

        Ceasa_product::create([
                        
            
            'name'       => 'ABACATE AVOCADO',
       
        ]);

        Ceasa_product::create([
                        
            
            'name'       => 'ABACATE BREDA',
       
        ]);

 
     }
    
}
