<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lancamentos_transportes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('obra_id')->constrained('obras')->onDelete('cascade');
            $table->foreignId('material_id')->nullable()->constrained('materiais')->nullOnDelete();
            $table->foreignId('prestador_id')->nullable()->constrained('prestadores')->nullOnDelete();
            $table->foreignId('transporte_id')->constrained('transportes')->onDelete('cascade');

            $table->date('data');
            $table->decimal('km', 8, 2);
            $table->decimal('valor_km', 10, 2);
            $table->decimal('valor_total', 12, 2)->default(0);
            $table->text('observacao')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lancamentos_transportes');
    }
};
