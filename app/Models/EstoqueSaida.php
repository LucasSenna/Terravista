<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstoqueSaida extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'data',
        'nota_fiscal',
        'quantidade',
        'unidade',
        'valor_unitario',
        'destino',
        'observacao',
    ];

    protected static function booted(): void
    {
        static::created(function ($saida) {
            // Atualiza estoque do item
            $item = $saida->item;
            $item->quantidade_total -= $saida->quantidade;
            $item->valor_total -= $saida->quantidade * ($saida->valor_unitario ?? 0);
            $item->save();
        });
    }

    public function item()
    {
        return $this->belongsTo(EstoqueItem::class);
    }
}
