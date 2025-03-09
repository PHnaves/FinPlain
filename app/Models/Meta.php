<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'id_user',
        'titulo',
        'descricao',
        'valor_final',
        'valor_atual',
        'periodicidade',
        'valor_periodico',
        'status',
    ];

    // Relacionamento com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
