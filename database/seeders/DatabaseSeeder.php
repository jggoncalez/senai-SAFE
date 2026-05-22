<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Professor;
use App\Models\Responsavel;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

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
            'name'     => 'Admin SAFE',
            'email'    => 'admin@safe.dev',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        $aqv = User::factory()->create([
            'name'     => 'AQV SAFE',
            'email'    => 'aqv@safe.dev',
            'password' => Hash::make('password'),
        ]);
        $aqv->assignRole('aqv');

        $professor = User::factory()->create([
            'name'     => 'Professor SAFE',
            'email'    => 'professor@safe.dev',
            'password' => Hash::make('password'),
        ]);
        $professor->assignRole('professor');
        Professor::factory()->create([
            'user_id'  => $professor->id,
            'turma_id' => $turmas->first()->id,
        ]);

        $portaria = User::factory()->create([
            'name'     => 'Portaria SAFE',
            'email'    => 'portaria@safe.dev',
            'password' => Hash::make('password'),
        ]);
        $portaria->assignRole('portaria');
    }
}
