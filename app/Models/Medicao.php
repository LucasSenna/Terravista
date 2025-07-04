<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Medicao extends Model
{
    use HasFactory;

    protected $table = 'medicoes';

    protected $fillable = [
        'obra_id',
        'prestador_id',
        'contrato_id',
        'numero',
        'data',
        'referente',
        'local',
        'quantidade',
        'valor_unitario',
        'valor_total',
        'status',
    ];

    protected static function booted(): void
    {
        static::saving(function (Medicao $medicao) {
            // Cálculo automático
            $medicao->valor_total = $medicao->quantidade * $medicao->valor_unitario;

            // Verifica atraso com base na data_fim da obra
            if (
                $medicao->obra &&
                $medicao->data &&
                Carbon::parse($medicao->data)->gt(Carbon::parse($medicao->obra->data_fim))
            ) {
                $medicao->status = 'em atraso';
            } else {
                $medicao->status = 'em dia';
            }

            // Garante que contrato esteja assinado
            if ($medicao->contrato?->status !== 'assinado') {
                throw new \Exception('Só é possível lançar medições com contrato assinado.');
            }
        });
    }

    public function obra() {
        return $this->belongsTo(Obra::class);
    }

    public function prestador() {
        return $this->belongsTo(Prestador::class);
    }

    public function contrato() {
        return $this->belongsTo(Contrato::class);
    }
}
