<?php

namespace Database\Factories;

use App\Models\Aluno;
use App\Models\Autorizacao;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Autorizacao>
 */
class AutorizacaoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'aluno_id'      => Aluno::factory(),
            'aqv_user_id'   => User::factory(),
            'tipo'          => $this->faker->randomElement(['entrada', 'saida']),
            'status'        => $this->faker->randomElement(['aprovado', 'confirmado']),
            'aulas_perdidas' => $this->faker->numberBetween(0, 4),
            'observacao'    => $this->faker->optional()->sentence(),
        ];
    }
}
