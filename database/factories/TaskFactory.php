<?php

namespace Database\Factories;

use App\Enums\TaskEnums;
use App\Models\Task;
use App\Models\User;
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
            Task::ID => fake()->uuid(),
            Task::USER_ID => User::factory(),
            Task::TITLE => fake()->sentence(),
            Task::DESCRIPTION => fake()->paragraph(),
            Task::DUE_DATE => fake()->dateTimeThisDecade(),
            Task::PRIORITY => fake()->randomElement(TaskEnums::get()),
        ];
    }
}
