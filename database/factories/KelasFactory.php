<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->jobTitle(),
            'course_id' => $this->faker->numberBetween(1, 50),
            'employee_id' => $this->faker->numberBetween(1, 50),
            'student_id' => $this->faker->numberBetween(1, 50)
        ];
    }
}
