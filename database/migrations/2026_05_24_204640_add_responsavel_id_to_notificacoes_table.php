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
        Schema::table('notificacoes', function (Blueprint $table) {
            $table->foreignId('responsavel_id')
                ->nullable()
                ->after('registro_id')
                ->constrained('responsaveis')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('notificacoes', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Responsavel::class);
            $table->dropColumn('responsavel_id');
        });
    }
};
