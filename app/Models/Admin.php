<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';

    protected $fillable = ['name', 'username', 'password'];

    protected $hidden = ['password', 'remember_token'];
}
