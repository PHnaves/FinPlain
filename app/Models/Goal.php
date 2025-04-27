<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'goal_title',
        'goal_description',
        'goal_category',
        'target_value',
        'current_value',
        'frequency',
        'recurring_value',
        'status',
        'end_date',
    ];

    public function deposits()
    {
        return $this->hasMany(Goal::class, 'goal_id');
    }

    // Relacionamento com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
