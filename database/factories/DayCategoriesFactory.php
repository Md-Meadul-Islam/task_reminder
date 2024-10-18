<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DayCategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->user_id,
            'day_name' => fake()->word(),
            'start_date' => fake()->date('Y-m-d', 'now'),
            'next_date' => fake()->date('Y-m-d'),
            'repeat' => fake()->randomElement(['once', 'everyday', 'every week', 'every fortnight', 'every month', 'every three month', 'every six month', 'every year']),
            'status' => fake()->randomElement(['active', 'paused']),
        ];
    }
}
