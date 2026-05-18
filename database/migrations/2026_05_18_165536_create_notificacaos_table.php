<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notificacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_id')
                ->constrained('registros_gate')
                ->cascadeOnDelete();
            $table->enum('canal', ['mail', 'telegram']);
            $table->enum('status', ['pendente', 'enviado', 'falhou'])
                ->default('pendente');
            $table->dateTime('enviado_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacoes');
    }
};
