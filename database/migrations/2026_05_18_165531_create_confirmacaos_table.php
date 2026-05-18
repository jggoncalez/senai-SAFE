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
        Schema::create('confirmacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('autorizacao_id')->constrained()->cascadeOnDelete();
            $table->foreignId('professor_id')->constrained()->cascadeOnDelete();
            $table->dateTime('confirmado_at');
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirmacaos');
    }
};
