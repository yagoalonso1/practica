<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlatformApartment; 
use App\Models\Apartment;          

class PlatformApartmentSeeder extends Seeder
{
    public function run(): void
    {
        PlatformApartment::factory(50)->create(); 
    }
}