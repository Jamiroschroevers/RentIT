<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname'   => fake()->firstName,
            'lastname'    => fake()->lastName,
            'birthday'    => fake()->date,
            'email'       => fake()->email,
            'phonenumber' => fake()->phoneNumber,
            'signature'   => fake()->name,
            'date'        => fake()->date,
        ];
    }
}
