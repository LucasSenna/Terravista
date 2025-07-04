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
