<?php

namespace Tests\Feature;

use App\Filament\Resources\Alunos\AlunoResource;
use App\Filament\Resources\Professors\ProfessorResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ResourceAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_aluno_resource_is_visible_only_to_admins(): void
    {
        $admin = $this->createUserWithRole('admin');
        $this->actingAs($admin);
        $this->assertTrue(AlunoResource::canViewAny());

        $professor = $this->createUserWithRole('professor');
        $this->actingAs($professor);
        $this->assertFalse(AlunoResource::canViewAny());
    }

    public function test_professor_resource_is_visible_only_to_admins(): void
    {
        $admin = $this->createUserWithRole('admin');
        $this->actingAs($admin);
        $this->assertTrue(ProfessorResource::canViewAny());

        $portaria = $this->createUserWithRole('portaria');
        $this->actingAs($portaria);
        $this->assertFalse(ProfessorResource::canViewAny());
    }

    private function createUserWithRole(string $role): User
    {
        Role::firstOrCreate(['name' => $role]);

        $user = User::factory()->create();
        $user->assignRole($role);

        return $user;
    }
}
