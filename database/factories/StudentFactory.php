<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'nis' => $this->faker->unique()->numberBetween(),
            'nisn' => $this->faker->numberBetween(),
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['MALE', 'FEMALE']),
            'age' => $this->faker->numberBetween(14, 23),
            'jurusan' => $this->faker->jobTitle(),
            'name_ortu' => $this->faker->name(),
            'phone_ortu' => $this->faker->numberBetween(),
            'tahun_masuk' => $this->faker->numberBetween(),
            'tahun_lulus' => $this->faker->numberBetween()
        ];
    }
}
