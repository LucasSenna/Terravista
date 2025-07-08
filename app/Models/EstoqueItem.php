<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstoqueItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'unidade',
        'quantidade_total',
        'valor_total',
    ];

    public function entradas()
    {
        return $this->hasMany(EstoqueEntrada::class, 'item_id');
    }

    public function saidas()
    {
        return $this->hasMany(EstoqueSaida::class, 'item_id');
    }
}
