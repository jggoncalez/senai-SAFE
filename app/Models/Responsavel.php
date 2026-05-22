<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Responsavel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'responsaveis';

    protected $fillable = [
        'aluno_id', 'nome', 'email',
        'telefone', 'telegram_chat_id', 'parentesco',
    ];

    public function routeNotificationForMail(): string
    {
        return $this->email;
    }

    public function aluno(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }
}
