<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LancamentoTransporte extends Model
{
    use HasFactory;

    protected $table = 'lancamentos_transportes';

    protected $fillable = [
        'obra_id',
        'material_id',
        'prestador_id',
        'transporte_id',
        'data',
        'km',
        'valor_km',
        'valor_total',
        'observacao',
    ];

    protected static function booted(): void
    {
        static::saving(function ($lancamento) {
            $lancamento->valor_total = $lancamento->km * $lancamento->valor_km;
        });
    }

    public function obra()
    {
        return $this->belongsTo(Obra::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function prestador()
    {
        return $this->belongsTo(Prestador::class);
    }

    public function transporte()
    {
        return $this->belongsTo(Transporte::class);
    }
}
