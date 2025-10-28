<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    
            //
           return [
            'titre' => $this->faker->sentence(3),
            'desc' => $this->faker->paragraph(),
            // On associe chaque cours à un user aléatoire (enseignant)
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
        ];
    }
}
