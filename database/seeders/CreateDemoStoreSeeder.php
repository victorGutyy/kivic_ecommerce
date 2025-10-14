<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Facades\Hash;

class CreateDemoStoreSeeder extends Seeder
{
    public function run(): void
    {
        $u = User::firstOrCreate(
            ['email' => 'admin@kivic.local'],
            ['name' => 'Admin', 'password' => Hash::make('password')]
        );

        Store::firstOrCreate(
            ['slug' => 'moda-basica'],
            ['owner_id' => $u->id, 'name' => 'Moda Básica', 'country' => 'CO', 'currency' => 'COP']
        );
    }
}
