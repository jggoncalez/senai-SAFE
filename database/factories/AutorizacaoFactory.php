<?php

namespace Database\Factories;

use App\Models\Aluno;
use App\Models\Autorizacao;
use App\Models\Responsavel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Autorizacao>
 */
class AutorizacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'aluno_id'       => Aluno::factory(),
            'responsavel_id' => Responsavel::factory(),
            'tipo'           => $this->faker->randomElement(['entrada', 'saida']),
            'status'         => $this->faker->randomElement(['pendente', 'aprovado']),
            'validade'       => $this->faker->dateTimeBetween('now', '+7 days'),
            'observacao'     => $this->faker->optional()->sentence(),
        ];
    }
}
