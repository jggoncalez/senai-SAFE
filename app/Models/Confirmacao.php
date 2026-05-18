<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Confirmacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'autorizacao_id', 'professor_id',
        'confirmado_at', 'observacao',
    ];

    protected $casts = [
        'confirmado_at' => 'datetime',
    ];

    public function autorizacao(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Autorizacao::class);
    }

    public function professor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Professor::class);
    }
}