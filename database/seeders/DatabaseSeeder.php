<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    
    public function run(): void
    {
        $this->call(GeraiSeeder::class);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Gudang User',
            'email' => 'gudang@example.com',
            'role' => 'gudang',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Gerai Dago',
            'email' => 'gerai.dago@example.com',
            'role' => 'gerai',
            'password' => bcrypt('password'),
        ]);
    }
}
