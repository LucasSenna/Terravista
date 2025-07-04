<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestador_id')->constrained('prestadores')->onDelete('cascade');
            $table->foreignId('obra_id')->nullable()->constrained('obras')->onDelete('set null');
            $table->string('tipo'); // Ex: equipamento, serviço
            $table->string('numero_contrato')->nullable();
            $table->date('data_contrato')->nullable();
            $table->enum('status', ['rascunho', 'assinado', 'cancelado'])->default('rascunho');
            $table->text('descricao')->nullable();
            $table->string('arquivo_pdf')->nullable(); // Caminho para contrato assinado
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('contratos');
    }
};

