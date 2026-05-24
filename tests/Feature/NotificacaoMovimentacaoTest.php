<?php

namespace Tests\Feature;

use App\Models\Aluno;
use App\Models\Autorizacao;
use App\Models\Notificacao;
use App\Models\RegistroGate;
use App\Models\Responsavel;
use App\Notifications\AlunoSaiuNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Tests\TestCase;

class NotificacaoMovimentacaoTest extends TestCase
{
    use RefreshDatabase;

    public function test_registro_gate_cria_notificacoes_para_responsaveis(): void
    {
        NotificationFacade::fake();

        $aluno = Aluno::factory()
            ->has(Responsavel::factory()->count(2), 'responsaveis')
            ->create();

        $autorizacao = Autorizacao::factory()->for($aluno)->create();

        $registro = RegistroGate::factory()->for($autorizacao)->create([
            'tipo' => 'saida',
        ]);

        $this->assertEquals(2, Notificacao::where('registro_id', $registro->id)->count());
        $this->assertDatabaseHas('notificacoes', [
            'registro_id' => $registro->id,
            'canal' => 'mail',
            'status' => 'enviado',
        ]);
        $this->assertEquals(
            0,
            Notificacao::where('registro_id', $registro->id)->whereNull('enviado_at')->count()
        );

        NotificationFacade::assertSentTo($aluno->responsaveis, AlunoSaiuNotification::class);
    }
}
