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
                        
            'name'          => 'Principio Ativo 1',
           
        ]);

        ActivePrinciple::create([
                        
            'name'          => 'Principio Ativo 2',
           
        ]);

        ActivePrinciple::create([
                        
    
            'name'          => 'Principio Ativo 3',
           
        ]);

        ActivePrinciple::create([
                        
            'name'          => 'Principio Ativo 4',
           
        ]);

        ActivePrinciple::create([
                        
            'name'          => 'Principio Ativo 5',
           
        ]);
       
          
        ActivePrinciple::create([
                        
            'name'          => 'Principio Ativo 6',
           
        ]);
        
    }
}
