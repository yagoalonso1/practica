<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\PlatformApartment;

class PlatformApartmentSeeder extends Seeder
{
    public function run(): void
    {
        PlatformApartment::factory(50)->create();
    }
}