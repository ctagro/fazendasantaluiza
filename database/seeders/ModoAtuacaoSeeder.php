<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliaries\Modo_atuacao;

class ModoAtuacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modo_atuacao ::create([
                        
            'user_id'       => 1,
            'name'          => 'Contato e Ingestão', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S' 
          
        ]);

        Modo_atuacao ::create([
                        
            'user_id'       => 1,
            'name'          => 'Sistêmico e de contato', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);

        Modo_atuacao ::create([
                        
            'user_id'       => 1,
            'name'          => 'Contato', 
            'description'   => '...',    
            'note'          => '...',
            'in_use'        => 'S'
          
        ]);
    }
}
