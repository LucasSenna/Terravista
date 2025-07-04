<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('medicoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra_id')->constrained('obras')->onDelete('cascade');
            $table->foreignId('prestador_id')->constrained('prestadores')->onDelete('cascade');
            $table->foreignId('contrato_id')->constrained('contratos')->onDelete('cascade');

            $table->string('numero');
            $table->date('data');
            $table->string('referente');
            $table->string('local');
            $table->decimal('quantidade', 12, 2);
            $table->decimal('valor_unitario', 12, 2);
            $table->decimal('valor_total', 12, 2)->default(0);
            $table->enum('status', ['em dia', 'em atraso'])->default('em dia');

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('medicoes');
    }
};
