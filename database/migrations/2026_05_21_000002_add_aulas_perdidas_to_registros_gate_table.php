<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registros_gate', function (Blueprint $table) {
            $table->tinyInteger('aulas_perdidas')->default(0)->after('observacao');
        });
    }

    public function down(): void
    {
        Schema::table('registros_gate', function (Blueprint $table) {
            $table->dropColumn('aulas_perdidas');
        });
    }
};
