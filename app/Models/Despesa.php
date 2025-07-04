<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'prestador_id',
        'tipo',
        'descricao',
        'valor',
        'vencimento',
        'forma_pagamento',
        'estado',
        'data_pagamento',
    ];

    protected $casts = [
        'vencimento' => 'date',
        'data_pagamento' => 'date',
    ];

    protected static function booted()
    {
        static::saving(function (Despesa $despesa) {
            // Se a data de pagamento estiver preenchida, marca como pago
            if ($despesa->data_pagamento !== null) {
                $despesa->estado = 'pago';
                return;
            }

            // Se vencido e ainda não pago
            if (
                in_array($despesa->estado, ['pendente', 'agendado']) &&
                $despesa->vencimento->isPast()
            ) {
                $despesa->estado = 'vencido';
            }
        });
    }

    public function prestador()
    {
        return $this->belongsTo(Prestador::class);
    }
}
