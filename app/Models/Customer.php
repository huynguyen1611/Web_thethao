<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'customers';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'city',
        'district',
        'ward',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
