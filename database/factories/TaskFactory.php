<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Enums\TaskType;
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
        ];
    }

    public function todo(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => STatus::TO_DO->value,
            ];
        });
    }

    public function mainType(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => TaskType::MAIN->value,
            ];
        });
    }
}
