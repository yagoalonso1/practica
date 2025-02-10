<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlatformApartment>
 */
class PlatformApartmentFactory extends Factory
{
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
