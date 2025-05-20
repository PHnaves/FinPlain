<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable //implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type_user',
        'rent',
        'monthly_income',
        'payment_frequency',
        'payment_day'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function despesas(): HasMany
    {
        return $this->hasMany(Expense::class, 'user_id');
    }

    public function goals()
    {
        return $this->hasMany(Goal::class, 'user_id');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }


    public function atualizarRenda()
    {
        $hoje = Carbon::now();
        $paymentDay = $this->payment_day;
        $paymentFrequency = $this->payment_frequency;

        if ($paymentFrequency === 'mensal') {
            if ($hoje->day === $paymentDay) {
                $this->rent += $this->monthly_income;
                $this->save();
            }

        } elseif ($paymentFrequency === 'quinzenal') {
            if ($hoje->day === $paymentDay || ($paymentDay === 15 && $hoje->day === 30)) {
                $this->rent += $this->monthly_income;
                $this->save();
            }
            
        } elseif ($paymentFrequency === 'semanal') {
            if ($hoje->dayOfWeek + 1 === $paymentDay) {
                $this->rent += $this->monthly_income;
                $this->save();
            }
        }
    }
}
