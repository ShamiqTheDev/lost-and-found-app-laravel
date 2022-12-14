<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "id";

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $guard = 'admin';

    public $tableName = 'admins';
}
