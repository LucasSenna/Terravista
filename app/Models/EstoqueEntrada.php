<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstoqueEntrada extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'data',
        'nota_fiscal',
        'quantidade',
        'unidade',
        'valor_unitario',
        'valor_total',
        'destino',
        'observacao',
    ];

    protected static function booted(): void
    {
        static::creating(function ($entrada) {
            $entrada->valor_total = $entrada->quantidade * $entrada->valor_unitario;
        });

        static::created(function ($entrada) {
            $item = $entrada->item;
            $item->quantidade_total += $entrada->quantidade;
            $item->valor_total += $entrada->valor_total;
            $item->save();
        });
    }

    public function item()
    {
        return $this->belongsTo(EstoqueItem::class, 'item_id');
    }
}
