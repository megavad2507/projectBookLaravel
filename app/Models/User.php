<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = ['name','email','password','is_admin'];

    protected $hidden = ['password','remember_token',];

    protected $casts = ['email_verified_at' => 'datetime',];

    public function isAdmin() {
        return $this->is_admin === 1;
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
    public function adminFilterInputs() {
        return [
            'id' => [
                'name' => 'ID',
                'type' => 'text'
            ],
            'email' => [
                'name' => 'Email',
                'type' => 'text'
            ],

        ];
    }
    use HasFactory, Notifiable;
}
