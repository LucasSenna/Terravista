<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiais';

    protected $fillable = [
        'obra_id',
        'prestador_id',
        'tipo',
        'data',
        'unidade',
        'quantidade',
        'valor_unitario',
        'valor_total',
        'frete',
        'ticket',
        'observacao',
    ];

    protected static function booted(): void
    {
        static::saving(function (Material $material) {
            $material->valor_total =
                ($material->quantidade * $material->valor_unitario) + ($material->frete ?? 0);
        });

        static::created(function (Material $material) {
            if (empty($material->ticket)) {
                $material->ticket = str_pad($material->id, 6, '0', STR_PAD_LEFT);
                $material->save();
            }
        });
    }

    public function obra()
    {
        return $this->belongsTo(Obra::class);
    }

    public function prestador()
    {
        return $this->belongsTo(Prestador::class);
    }
}
