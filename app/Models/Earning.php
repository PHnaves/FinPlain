<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'value',
        'recurrence',
        'received_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 