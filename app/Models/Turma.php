<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turma extends Model
{
    use HasFactory;

    protected $table = 'turmas';

    protected $fillable = ['nome', 'periodo', 'ano_letivo'];

    public function alunos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Aluno::class);
    }

    public function professores(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Professor::class);
    }
}