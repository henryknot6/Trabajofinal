<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategoriaSeeder::class,
            HabilidadSeeder::class,
        ]);
        
        \App\Models\User::factory()->create([
             'name' => 'Admin Chaymba',
             'email' => 'admin@chaymba.com',
             'rol' => 'cliente', 
             'password' => bcrypt('password'), 
        ]);
    }
}