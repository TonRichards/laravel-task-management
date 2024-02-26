<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Status>
 */
class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }

    public function todo(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'todo',
                'display_name' => 'Todo',
            ];
        });
    }
}
