<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('despesas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestador_id')->constrained('prestadores')->onDelete('cascade');
            $table->enum('tipo', ['aluguel', 'fixa']);
            $table->string('descricao');
            $table->decimal('valor', 12, 2);
            $table->date('vencimento');
            $table->enum('forma_pagamento', ['PIX', 'TED', 'DINHEIRO', 'BOLETO']);
            $table->enum('estado', ['pendente', 'agendado', 'pago', 'vencido'])->default('pendente');
            $table->date('data_pagamento')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('despesas');
    }
};

