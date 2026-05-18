<?php

namespace Database\Factories;

use App\Models\Notificacao;
use App\Models\RegistroGate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Notificacao>
 */
class NotificacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'registro_id' => RegistroGate::factory(),
            'canal'       => $this->faker->randomElement(['mail', 'telegram']),
            'status'      => $this->faker->randomElement(['pendente', 'enviado', 'falhou']),
            'enviado_at'  => $this->faker->optional()->dateTimeThisMonth(),
        ];
    }
}
