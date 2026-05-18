<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Autorizacao extends Model
{
    use HasFactory;

    protected $table = 'autorizacoes';

    protected $fillable = [
        'aluno_id', 'responsavel_id', 'tipo',
        'status', 'validade', 'observacao',
    ];

    protected $casts = [
        'validade' => 'datetime',
    ];

    public function aluno(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    public function responsavel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Responsavel::class);
    }

    public function confirmacao(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Confirmacao::class);
    }

    public function registrosGate(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RegistroGate::class);
    }

    public function estaValida(): bool
    {
        return $this->status === 'aprovado'
            && $this->validade->isFuture();
    }
}