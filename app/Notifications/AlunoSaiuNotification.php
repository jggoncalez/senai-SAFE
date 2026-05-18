<?php

namespace App\Notifications;

use App\Models\Aluno;
use App\Models\RegistroGate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AlunoSaiuNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Aluno $aluno,
        public RegistroGate $registro,
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('SAFE — Saída registrada')
            ->greeting("Olá, {$notifiable->nome}!")
            ->line("O aluno **{$this->aluno->nome}** saiu da escola.")
            ->line("🕐 Horário: {$this->registro->registrado_at->format('d/m/Y H:i')}")
            ->line("📍 Registrado por: {$this->registro->user->name}")
            ->line('Esta é uma notificação automática do sistema SAFE.')
            ->salutation('Atenciosamente, SAFE Sistema Escolar');
    }
}