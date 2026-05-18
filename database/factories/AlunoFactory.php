<?php

namespace Database\Factories;

use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Aluno>
 */
class AlunoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'turma_id'  => Turma::factory(),
            'nome'      => $this->faker->name(),
            'matricula' => $this->faker->unique()->numerify('ALU-#####'),
            'foto_url'  => null,
        ];
    }
}
