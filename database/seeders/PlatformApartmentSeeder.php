<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlatformApartment;
use App\Models\Apartment;
use App\Models\Platform;

class PlatformApartmentSeeder extends Seeder
{
    public function run(): void
    {
        $apartments = Apartment::all();
        $platforms = Platform::all();

        // Verificar que existan apartamentos y plataformas antes de crear relaciones
        if ($apartments->count() > 0 && $platforms->count() > 0) {
            foreach (range(1, 50) as $index) {
                PlatformApartment::factory()->create([
                    'apartment_id' => $apartments->random()->id,
                    'platform_id' => $platforms->random()->id,
                ]);
            }
        }
    }
}