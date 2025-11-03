<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Asegura un usuario #1 para owner_id
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        $this->call(DemoStoreSeeder::class); // OJO: DemoStoreSeeder, no DemoSeeder
    }
}

