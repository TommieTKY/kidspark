<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Program;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            // 'icon' => fake()->imageUrl(640, 480, 'people'),
            'icon' => $this->generateFakeImage(),
            'bio' => fake()->paragraph(),
            // 'program_id' => Program::exists() ? Program::all()->random()->id : null,
        ];
    }

    private function generateFakeImage(): string
    {
        $imageName = fake()->image(
            storage_path('app/public/instructors'), 
            640, 
            480,
            'people', 
            false 
        );

        return 'instructors/' . $imageName;
    }
}
