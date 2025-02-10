<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment; 
use App\Models\PlatformApartment; 

class ApartmentSeeder extends Seeder
{
    public function run(): void
    {
        PlatformApartment::factory(50)->create();
    }
}