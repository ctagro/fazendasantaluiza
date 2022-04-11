<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // \App\Models\User::factory(1000)->create();
        \App\Models\User::create([
            'name' => 'System Admin',
            'first_name' => 'System',
            'last_name' => 'Admin',
            'phone_number' => '11 95056-5771',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('asdfqwer'), // password
            'remember_token' => (Str::random(10)),
    ]);

        \App\Models\User::create([
            'name' => 'Edson',
            'first_name' => 'Costa',
            'last_name' => 'Edson',
            'phone_number' => '23 98414-7887',
            'email' => 'edson@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('edson123'), // password
            'remember_token' => (Str::random(10)),
    ]);

        \App\Models\User::create([
            'name' => 'Wemerson',
            'first_name' => 'Wemerson',
            'last_name' => 'ww',
            'phone_number' => '23 99943-0316',
            'email' => 'wemersonfazendasantaluiza@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('wemerson123'), // password
            'remember_token' => (Str::random(10)),
        ]);

    }
}
