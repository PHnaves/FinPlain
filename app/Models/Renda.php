<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renda extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'id_user',
        'valor',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
