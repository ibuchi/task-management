<?php

namespace Database\Factories;

use Carbon\Carbon;
use DateInterval;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween(now(), now()->addMonths(5));

        return [
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'start_date' => $startDate,
            'end_date' => Carbon::parse($startDate)->addMonth(),
        ];
    }
}
