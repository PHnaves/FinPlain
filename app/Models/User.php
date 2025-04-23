<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable implements MustVerifyEmail
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

    public function notificacoes()
    {
        return $this->hasMany(Notificacao::class, 'id_user'); // Ajuste para o nome correto da FK
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }

}
