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
    Schema::table('contratos', function (Blueprint $table) {
        $table->date('inicio_locacao')->nullable();
        $table->string('tipo_faturamento')->nullable();
        $table->string('forma_pagamento')->nullable();
        $table->decimal('valor_mensal', 12, 2)->nullable();
        $table->integer('horas_mensais')->nullable()->default(200);
        $table->decimal('taxa_kit_capa', 10, 2)->nullable();
        $table->text('descricao_equipamento')->nullable();
        $table->text('dados_bancarios')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
