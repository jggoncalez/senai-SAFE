<?php

namespace Database\Factories;

use App\Models\Turma;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Turma>
 */
class TurmaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'      => 'Turma ' . $this->faker->bothify('??-##'),
            'periodo'   => $this->faker->randomElement(['manha', 'tarde', 'noite']),
            'ano_letivo' => $this->faker->year() . '/' . ($this->faker->year() + 1),
        ];
    }
}
