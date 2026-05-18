<?php

namespace Database\Factories;

use App\Models\Autorizacao;
use App\Models\RegistroGate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RegistroGate>
 */
class RegistroGateFactory extends Factory
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
            'user_id'        => User::factory(),
            'tipo'           => $this->faker->randomElement(['entrada', 'saida']),
            'registrado_at'  => now(),
            'observacao'     => $this->faker->optional()->sentence(),
        ];
    }
}
