<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Type>
 */
class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->randomDigitNot(0),
            'name' => fake()->slug(),
            'display_name' => fake()->name(),
        ];
    }

    public function space(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'scope' => 'space',
            ];
        });
    }
}
