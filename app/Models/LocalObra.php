<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalObra extends Model
{
    use HasFactory;

    protected $fillable = ['logradouro', 'estado'];

    public function obras()
    {
        return $this->hasMany(Obra::class);
    }
}
