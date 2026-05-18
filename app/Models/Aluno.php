<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = ['turma_id', 'nome', 'matricula', 'foto_url'];

    public function turma(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Turma::class);
    }

    public function responsaveis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Responsavel::class);
    }

    public function autorizacoes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Autorizacao::class);
    }
}