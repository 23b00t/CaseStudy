<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->fake->company(),
            'description' => $this->fake->paragraph(),
            'user_id' => \App\Models\User::where('role', 'company')->inRandomOrder()->first()->id ?? \App\Models\User::factory()->company(),
        ];
    }
}
