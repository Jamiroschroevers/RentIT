<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street' => fake()->streetName,
            'house_number' => fake()->numberBetween(1,100),
            'postal_code' => fake()->postcode,
            'city' => fake()->city,
            'status' => Status::FOR_RENT
        ];
    }
}
