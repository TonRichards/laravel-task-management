<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Space>
 */
class SpaceFactory extends Factory
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
            'uuid' =>fake()->uuid(),
            'slug' => fake()->slug(),
            'name' => fake()->name(),
            'type_id' => 1,
            'user_id' => 1,
        ];
    }
}
