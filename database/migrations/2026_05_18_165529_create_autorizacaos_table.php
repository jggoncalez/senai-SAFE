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
            $table->foreignId('aluno_id')->constrained('alunos')->cascadeOnDelete();
            $table->foreignId('aqv_user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('tipo', ['entrada', 'saida']);
            $table->enum('status', ['aprovado', 'confirmado', 'concluido', 'cancelado'])
                ->default('aprovado');
            $table->tinyInteger('aulas_perdidas')->default(0);
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autorizacoes');
    }
};
