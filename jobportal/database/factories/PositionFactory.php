<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->fake->jobTitle(),
            'description' => $this->fake->paragraph(),
            'location' => $this->fake->city(),
            'salary' => $this->fake->numberBetween(30000, 120000),
            'company_id' => \App\Models\Company::factory(),
            'category_id' => \App\Models\Category::factory(),
            'user_id' => \App\Models\User::factory()->company(),
        ];
    }
}
