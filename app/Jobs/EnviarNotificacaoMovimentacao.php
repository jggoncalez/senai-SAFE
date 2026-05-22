<?php

namespace App\Jobs;

use App\Models\RegistroGate;
use App\Notifications\AlunoSaiuNotification;
use App\Notifications\AlunoEntrouNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;
use UnexpectedValueException;

class EnviarNotificacaoMovimentacao implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public RegistroGate $registro,
    ) {}

    public function handle(): void
    {
        $registro = $this->registro->load([
            'autorizacao.aluno.responsaveis',
            'user',
        ]);

        $aluno        = $registro->autorizacao->aluno;
        $responsaveis = $aluno->responsaveis;

        $notification = match($registro->tipo) {
            'saida'   => new AlunoSaiuNotification($aluno, $registro),
            'entrada' => new AlunoEntrouNotification($aluno, $registro),
            default   => null,
        };

        if (! $notification) {
            report(new UnexpectedValueException("Tipo de registro desconhecido: {$registro->tipo}"));
            return;
        }

        foreach ($responsaveis as $responsavel) {
            try {
                $responsavel->notify($notification);
            } catch (Throwable $exception) {
                report($exception);
            }
        }
    }
}
