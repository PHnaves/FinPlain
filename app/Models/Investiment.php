<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investiment extends Model
{
    protected $fillable = [
        'investiment_name',
        'investiment_description',
        'investiment_type',
        'recommended_profile',
        'expiration_date',
        'minimum_value'
    ];

}
