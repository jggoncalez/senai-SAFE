<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aluno;
use App\Models\Professor;
use App\Models\Responsavel;
use App\Models\Turma;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $turmas = Turma::factory(6)->create();

        $alunos = $turmas->flatMap(function ($turma) {
            return Aluno::factory(10)
                ->create(['turma_id' => $turma->id]);
        });

        $alunos->each(function ($aluno) {
            Responsavel::factory(2)
                ->create(['aluno_id' => $aluno->id]);
        });

        $turmas->each(function ($turma) {
            $user = User::factory()->create();
            $user->assignRole('professor');
            Professor::factory()->create([
                'user_id'  => $user->id,
                'turma_id' => $turma->id,
            ]);
        });

        $admin = User::factory()->create([
            'name'  => 'Admin SAFE',
            'email' => 'admin@safe.dev',
        ]);
        $admin->assignRole('admin');

        $portaria = User::factory()->create([
            'name'  => 'Portaria SAFE',
            'email' => 'portaria@safe.dev',
        ]);
        $portaria->assignRole('portaria');
    }
}
