<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'proprietario',
        'placa',
        'destino',
        'data_inicio',
        'data_fim',
    ];

    public function lancamentos()
    {
        return $this->hasMany(LancamentoTransporte::class);
    }
}
