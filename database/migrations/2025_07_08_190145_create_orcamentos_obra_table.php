<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orcamentos_obra', function (Blueprint $table) {
            $table->id();

            $table->foreignId('obra_id')->constrained('obras')->onDelete('cascade');

            $table->string('etapa'); // Nome da etapa ou item orçamentário
            $table->string('unidade')->nullable(); // ex: m³, m², kg, h
            $table->decimal('quantidade_prevista', 10, 2);
            $table->decimal('valor_unitario_previsto', 12, 2);
            $table->decimal('total_previsto', 14, 2)->default(0);

            $table->string('categoria')->nullable(); // Material, Serviço, Frete, etc

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('orcamentos_obra');
    }
};
