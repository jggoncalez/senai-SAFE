<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Responsavel extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id', 'nome', 'email',
        'telefone', 'telegram_chat_id', 'parentesco',
    ];

    public function aluno(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    public function autorizacoes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Autorizacao::class);
    }
}