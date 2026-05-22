<?php
namespace App\Models;

use App\Jobs\EnviarNotificacaoMovimentacao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistroGate extends Model
{
    use HasFactory;

    protected $table = 'registros_gate';

    protected $fillable = [
        'autorizacao_id', 'user_id',
        'tipo', 'registrado_at', 'observacao', 'aulas_perdidas',
    ];

    protected $casts = [
        'registrado_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::created(function (RegistroGate $registro) {
            EnviarNotificacaoMovimentacao::dispatchSync($registro);
        });
    }

    public function autorizacao()
    {
        return $this->belongsTo(Autorizacao::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notificacoes()
    {
        return $this->hasMany(Notificacao::class, 'registro_id');
    }
}