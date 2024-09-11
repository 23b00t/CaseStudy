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
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->city(),
            'salary' => $this->faker->numberBetween(30000, 120000),
            'company_id' => \App\Models\Company::inRandomOrder()->first()->id ?? \App\Models\Company::factory(),
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id ?? \App\Models\Category::factory(),
            'user_id' => \App\Models\User::where('role', 'company')->inRandomOrder()->first()->id ?? \App\Models\User::factory()->company(),
        ];
    }
}
