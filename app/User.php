<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Nasabah;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function nasabah()
    {
        return $this->hasMany(Nasabah::class, 'user_id', 'id');
    }
    public function token_generator()
    {
        return $this->hasMany(token_generator::class, 'user_id', 'id');
    }
}