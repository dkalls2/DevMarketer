<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laratrust\Traits\LaratrustUserTrait;
//we need to add this from Laratrust

class User extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait;
        //this will inherit all of the functionality like hasRole, etc.

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
