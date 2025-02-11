<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PlatformApartment;
use App\Models\Apartment;
use App\Models\Platform;

class PlatformApartmentFactory extends Factory
{
    protected $model = PlatformApartment::class; 

    public function definition(): array
    {
        return [
            'register_date' => fake()->date(),
            'premium' => fake()->boolean(),
            'apartment_id' => Apartment::factory(),
            'platform_id' => Platform::factory(),
        ];
    }
}