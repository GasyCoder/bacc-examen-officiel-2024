<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidat>
 */
class CandidatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'matricule' => $this->faker->unique()->numerify('#######'),
            'fname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            'serie' => $this->faker->randomElement(['A1', 'A2', 'D']),
            'mention' => $this->faker->randomElement(['Passable', 'Bien', 'Très Bien', null]),
            'center' => $this->faker->city(),
            'admis' => $this->faker->boolean(),
        ];
    }
}
