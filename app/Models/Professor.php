<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'turma_id', 'nome', 'matricula'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function turma(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Turma::class);
    }

    public function confirmacoes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Confirmacao::class);
    }
}