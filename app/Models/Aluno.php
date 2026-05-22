<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'alunos';

    protected $fillable = ['turma_id', 'responsavel_principal_id', 'nome', 'matricula', 'foto_url'];

    public function turma(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Turma::class);
    }

    public function responsavelPrincipal(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Responsavel::class, 'responsavel_principal_id');
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