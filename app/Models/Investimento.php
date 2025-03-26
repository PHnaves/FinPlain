<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investimento extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'tipo',
        'perfil_recomendado',
        'prazo',
        'valor_recomendado'
    ];
}
