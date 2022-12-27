<?php

namespace Database\Factories;

use App\Models\Salary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'salary_id' => Salary::all()->random()->id,
            'name' => 'Department of '.fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'location' => fake()->city(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
        ];
    }
}
