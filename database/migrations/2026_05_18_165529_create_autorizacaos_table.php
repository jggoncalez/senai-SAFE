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
        Schema::create('autorizacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained()->cascadeOnDelete();
            $table->foreignId('responsavel_id')->constrained()->cascadeOnDelete();
            $table->enum('tipo', ['entrada', 'saida']);
            $table->enum('status', ['pendente', 'aprovado', 'expirado', 'cancelado'])
                ->default('pendente');
            $table->dateTime('validade');
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autorizacaos');
    }
};
