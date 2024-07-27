<?php

namespace Database\Factories;

use App\Enums\Type as TypeEnum;
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
            'name' => fake()->slug(),
            'display_name' => fake()->name(),
        ];
    }

    public function task(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'scope' => 'task',
            ];
        });
    }

    public function mainSpace(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'scope' => 'space',
                'name' => TypeEnum::MAIN_SPACE->value,
            ];
        });
    }
}
