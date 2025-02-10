<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Apartment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ApartmentSeeder::class,
            PlatformSeeder::class,
            PlatformApartmentSeeder::class,
        ]);
    }
}