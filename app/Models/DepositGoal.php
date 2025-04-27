<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepositGoal extends Model
{
    protected $table = 'deposits_goal';
    
    protected $fillable = [
        'goal_id',
        'deposit_value'
    ];

    // Relacionamento com as metas
    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}
