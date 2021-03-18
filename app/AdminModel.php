<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AdminModel extends Authenticable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $table = 'admins';
    protected $fillable = [
        'name', 'email', 'username', 'password'
    ];

    public $timestamps = false;

    protected $hidden = ['password'];
}
