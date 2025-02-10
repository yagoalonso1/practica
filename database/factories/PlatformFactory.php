<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Platform>
 */
class PlatformFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'owner' => fake()->name(),
        ];
    }
}