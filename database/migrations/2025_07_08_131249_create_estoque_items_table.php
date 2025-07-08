<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('estoque_items', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->string('unidade')->nullable();
            $table->decimal('quantidade_total', 10, 2)->default(0);
            $table->decimal('valor_total', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('estoque_items');
    }
};
