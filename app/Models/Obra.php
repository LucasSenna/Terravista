<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Obra extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'local_obra_id',
        'responsavel_id',
        'data_inicio',
        'data_fim',
        'status',
        'planilha_orcamentaria',
    ];

    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(Tecnico::class, 'responsavel_id');
    }

    public function localObra()
    {
        return $this->belongsTo(LocalObra::class, 'local_obra_id');
    }
}
