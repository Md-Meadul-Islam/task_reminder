<?php

namespace Database\Factories;

use App\Models\DayCategories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TasksFactory extends Factory
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
            'day_category_id' => DayCategories::all()->random()->id,
            // 'day_category_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'task_body' => fake()->text(),
            'remark' => fake()->sentence(10),
            'alarm_time' => fake()->dateTime(),
            'remind_before' => fake()->numberBetween(1, 60),
        ];
    }
}
