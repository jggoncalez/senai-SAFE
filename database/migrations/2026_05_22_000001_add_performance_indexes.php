<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Composite index para queries de status + data (badges e widgets)
        Schema::table('autorizacoes', function (Blueprint $table) {
            $table->index(['status', 'created_at'], 'autorizacoes_status_created_at_index');
        });

        // Index para whereHas/whereDoesntHave em confirmacoes
        Schema::table('confirmacoes', function (Blueprint $table) {
            $table->index('autorizacao_id', 'confirmacoes_autorizacao_id_index');
        });

        // Index para whereHas/whereDoesntHave em registros_gate
        Schema::table('registros_gate', function (Blueprint $table) {
            $table->index('autorizacao_id', 'registros_gate_autorizacao_id_index');
        });
    }

    public function down(): void
    {
        Schema::table('autorizacoes', function (Blueprint $table) {
            $table->dropIndex('autorizacoes_status_created_at_index');
        });

        Schema::table('confirmacoes', function (Blueprint $table) {
            $table->dropIndex('confirmacoes_autorizacao_id_index');
        });

        Schema::table('registros_gate', function (Blueprint $table) {
            $table->dropIndex('registros_gate_autorizacao_id_index');
        });
    }
};
