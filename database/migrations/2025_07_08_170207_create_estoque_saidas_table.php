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
        Schema::create('estoque_saidas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('estoque_items')->onDelete('cascade');
            $table->date('data');
            $table->string('nota_fiscal')->nullable();
            $table->decimal('quantidade', 10, 2);
            $table->string('unidade')->nullable();
            $table->decimal('valor_unitario', 12, 2)->nullable();
            $table->string('destino')->nullable();
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoque_saidas');
    }
};
