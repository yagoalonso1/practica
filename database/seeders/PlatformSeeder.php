<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Platform;
class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        Platform::factory(3)->create();
    }
}