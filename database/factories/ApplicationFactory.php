<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => rand(1,100),
            'leave_id' => rand(1,3),
            'date_from' => fake()->dateTimeBetween('2023-12-27', '2023-12-31'),
            'date_to' => fake()->dateTimeBetween('2023-12-27', '2023-12-31'),
            'remark' => fake()->sentence(10),
        ];
    }
}
