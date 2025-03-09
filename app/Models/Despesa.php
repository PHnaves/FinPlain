<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{

    use HasFactory;

    protected $fillable = [
        'id_user',
        'tipo',
        'valor',
        'recorrente',
        'data_vencimento'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
