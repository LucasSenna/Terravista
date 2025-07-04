<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestador extends Model {
    use HasFactory;

    protected $table = 'prestadores';

    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'representante',
        'email',
        'telefone',
        'endereco',
        'banco',
        'agencia',
        'conta_corrente',
        'chave_pix',
        'observacoes',
    ];
}