<?php

namespace Database\Factories;

use App\Models\Aluno;
use App\Models\Responsavel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Responsavel>
 */
class ResponsavelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'aluno_id'         => Aluno::factory(),
            'nome'             => $this->faker->name(),
            'email'            => $this->faker->unique()->safeEmail(),
            'telefone'         => $this->faker->numerify('(19) 9####-####'),
            'telegram_chat_id' => null,
            'parentesco'       => $this->faker->randomElement([
                'pai', 'mae', 'avo', 'ava', 'tio', 'tia', 'responsavel_legal', 'outro'
            ]),
        ];
    }
}
