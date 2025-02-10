<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Platform;

class PlatformFactory extends Factory
{
    protected $model = Platform::class; 

    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'owner' => fake()->name(),
        ];
    }
}