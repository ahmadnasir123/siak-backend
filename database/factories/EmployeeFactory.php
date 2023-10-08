<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => $this->faker->unique()->numberBetween(),
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'gender' => $this->faker->randomElement(['MALE', 'FEMALE']),
            'age' => $this->faker->numberBetween(22, 55),
            'photo' => $this->faker->imageUrl(),
            'phone' => $this->faker->phoneNumber(),
            'user_id' => $this->faker->numberBetween(1, 50),
            'position_id' => $this->faker->numberBetween(1, 30),
            'course_id' => $this->faker->numberBetween(1, 50),
            'kelas_id' => $this->faker->numberBetween(1, 35)

        ];
    }
}
