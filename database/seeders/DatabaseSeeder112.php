<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
     //  $this->call(UserTableSeeder::class);   
  //     $this->call(CropTableSeeder::class);
   //    $this->call(ActivePrincipleSeeder::class);
  //     $this->call(CeasaProductSeeder::class);
  //     $this->call(Crop_diseaseSeeder::class);
  //     $this->call(CropSeeder::class);
  //     $this->call(CropVarietySeeder::class);
  //     $this->call(DiseaseSeeder::class);
  //     $this->call(PesticideSeeder::class);
  //     $this->call(Price_ceasa_bhSeeder::class);
       $this->call(UserSeeder::class);
   


    }
}
