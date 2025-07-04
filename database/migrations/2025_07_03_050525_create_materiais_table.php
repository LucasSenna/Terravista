<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('materiais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra_id')->constrained('obras')->onDelete('cascade');
            $table->foreignId('prestador_id')->constrained('prestadores')->onDelete('cascade');
            $table->string('tipo');
            $table->date('data');
            $table->string('unidade');
            $table->decimal('quantidade', 10, 2);
            $table->decimal('valor_unitario', 12, 2);
            $table->decimal('valor_total', 12, 2)->default(0);
            $table->decimal('frete', 12, 2)->nullable();
            $table->string('ticket')->nullable();
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('materiais');
    }
};
