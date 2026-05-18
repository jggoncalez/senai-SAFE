<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistroGate extends Model
{
    use HasFactory;

    protected $table = 'registros_gate';

    protected $fillable = [
        'autorizacao_id', 'user_id',
        'tipo', 'registrado_at', 'observacao',
    ];

    protected $casts = [
        'registrado_at' => 'datetime',
    ];

    public function autorizacao(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Autorizacao::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function notificacoes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Notificacao::class, 'registro_id');
    }
}