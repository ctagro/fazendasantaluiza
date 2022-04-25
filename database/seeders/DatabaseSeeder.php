<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      //   \App\Models\User::factory(1000)->create();
      /*  \App\Models\User::create([
            'name' => 'System Admin',
            'first_name' => 'System',
            'last_name' => 'Admin',
            'phone_number' => '11 95056-5771',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('asdfqwer'), // password
            'remember_token' => Str::random(10),
        ]);
*/

//==================  Ceasa ===============
      //  $this->call(CeasaProductSeeder::class);

//===============   principal ========
        $this->call(UserSeeder::class); 
        $this->call(CeasaProductSeeder::class);
        $this->call(CropSeeder::class);
        $this->call(CropVarietySeeder::class);
        $this->call(DiseaseSeeder::class);
        $this->call(Price_ceasa_bhSeeder::class);
        $this->call(PesticideSeeder::class);
        $this->call(ActivePrincipleSeeder::class);

// =========   Auxiliares ======
         $this->call(AgronomicClassSeeder::class);
          $this->call(FormulationTypeSeeder::class);
          $this->call(ManufacturerSeeder::class);
          $this->call(ApplicationModeSeeder::class);
          $this->call(ChemicalGroupSeeder::class); 
          $this->call(ToxicologicalClassSeeder::class);
          $this->call(ActionSiteSeeder::class);  
          $this->call(ModeOperationSeeder::class); 
          $this->call(ActuationMechanismSeeder::class); 
    }
}
