<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Instructor;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(640, 480, 'business'),
            'price' => fake()->numberBetween(100, 1000),
            // 'instructor_id' => Instructor::exists() ? Instructor::all()->random()->id : null,
        ];
    }
}
