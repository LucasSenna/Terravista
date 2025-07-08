<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrcamentoObra extends Model
{
    use HasFactory;

    protected $table = 'orcamentos_obra';

    protected $fillable = [
        'obra_id',
        'etapa',
        'unidade',
        'quantidade_prevista',
        'valor_unitario_previsto',
        'total_previsto',
        'categoria',
    ];

    protected static function booted(): void
    {
        static::saving(function ($orcamento) {
            $orcamento->total_previsto = $orcamento->quantidade_prevista * $orcamento->valor_unitario_previsto;
        });
    }

    public function obra()
    {
        return $this->belongsTo(Obra::class);
    }
}
