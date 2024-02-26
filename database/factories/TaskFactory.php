<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'name' => fake()->name(),
            'body' => fake()->paragraph(),
            'user_id' => 1,
        ];
    }

    public function todo(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status_id' => 1,
            ];
        });
    }
}
