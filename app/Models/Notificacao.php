<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    use HasFactory;

    protected $table = 'notificacoes';
    
    protected $fillable = [
        'id_user',
        'mensagem',
        'lida'
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'id_user');
    }
}
