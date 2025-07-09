<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'prestador_id',
        'obra_id',
        'tipo',
        'numero_contrato',
        'data_contrato',
        'inicio_locacao',
        'tipo_faturamento',
        'forma_pagamento',
        'valor_mensal',
        'horas_mensais',
        'taxa_kit_capa',
        'descricao_equipamento',
        'dados_bancarios',
        'status',
        'descricao',
        'arquivo_pdf',
    ];

    public function prestador()
    {
        return $this->belongsTo(Prestador::class);
    }

    public function obra()
    {
        return $this->belongsTo(Obra::class);
    }
}
