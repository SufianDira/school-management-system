<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Classroom;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->student(),
            'date_of_birth' => $this->faker->dateTimeBetween('-24 years', '-18 years')->format('Y-m-d'),
            'assigned_class_id' => null,
            'grade' => (string) $this->faker->numberBetween(0, 100),
        ];
    }
}
