<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Model\Role;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndPermissions;

    public static $ADMINISTRADOR = 1;
    public static $NIVEL_ESTRATEGICO = 2;
    public static $NIVEL_TACTICO = 3;

    public static $EMPLEADO_UES = 1;
    public static $PRACTICANTE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'estado', 'tipo',
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

    public function roles()
    {
        return $this->belongsToMany('Caffeinated\Shinobi\Models\Role');
    }
}
