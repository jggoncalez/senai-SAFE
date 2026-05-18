<?php

namespace Database\Factories;

use App\Models\Professor;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Professor>
 */
class ProfessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'   => User::factory(),
            'turma_id'  => Turma::factory(),
            'nome'      => $this->faker->name(),
            'matricula' => $this->faker->unique()->numerify('PROF-####'),
        ];
    }
}
