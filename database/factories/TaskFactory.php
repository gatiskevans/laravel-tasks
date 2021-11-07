<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => null,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'completed_at' => null,
            'deleted_at' => null
        ];
    }
}
