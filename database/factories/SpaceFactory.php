<?php

namespace Database\Factories;

use App\Enums\SpaceType;
use App\Enums\Status;
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
            'uuid' => fake()->uuid(),
            'name' => fake()->name(),
        ];
    }

    public function projectType(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => SpaceType::PROJECT->value,
            ];
        });
    }

    public function folderType(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => SpaceType::FOLDER->value,
            ];
        });
    }

    public function todoStatus(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => Status::TO_DO->value,
            ];
        });
    }
}
