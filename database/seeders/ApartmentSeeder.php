<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Apartment;

class ApartmentSeeder extends Seeder
{
    public function run(): void
    {
        Apartment::factory(20)->create();
    }
}