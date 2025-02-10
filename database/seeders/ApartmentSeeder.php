<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
\App\Models\Apartment;
class ApartmentSeeder extends Seeder
{
    public function run(): void
    {
       Apartment::factory(20)->create();
    }
}