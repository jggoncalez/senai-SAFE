<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->foreignId('responsavel_principal_id')
                ->nullable()
                ->after('turma_id')
                ->constrained('responsaveis')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->dropForeign(['responsavel_principal_id']);
            $table->dropColumn('responsavel_principal_id');
        });
    }
};
