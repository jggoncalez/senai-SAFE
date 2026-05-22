<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Autorizacao extends Model
{
    use HasFactory;

    protected $table = 'autorizacoes';

    protected $fillable = [
        'aluno_id', 'aqv_user_id', 'tipo',
        'status', 'aulas_perdidas', 'observacao',
    ];

    protected $casts = [
        'aulas_perdidas' => 'integer',
    ];

    public function getValidadeAttribute(): \Illuminate\Support\Carbon
    {
        return today()->endOfDay();
    }

    public function aluno(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    public function aqv(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'aqv_user_id');
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
        return $this->status === 'aprovado';
    }
}
