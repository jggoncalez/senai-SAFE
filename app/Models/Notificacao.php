<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notificacao extends Model
{
    use HasFactory;

    protected $table = 'notificacoes';

    protected $fillable = [
        'registro_id', 'canal', 'status', 'enviado_at',
    ];

    protected $casts = [
        'enviado_at' => 'datetime',
    ];

    public function registroGate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(RegistroGate::class, 'registro_id');
    }
}