<?php

namespace Database\Factories;

use App\Models\Autorizacao;
use App\Models\Confirmacao;
use App\Models\Professor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Confirmacao>
 */
class ConfirmacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'autorizacao_id' => Autorizacao::factory(),
            'professor_id'   => Professor::factory(),
            'confirmado_at'  => now(),
            'observacao'     => $this->faker->optional()->sentence(),
        ];
    }
}
