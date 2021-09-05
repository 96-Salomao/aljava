<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Permission;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users';
    protected $fillable = [
        'nome','email','bilhete','password','data_nascimento','telefone','type','id_sistemna','id_role'
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

    public function papels(){

        return $this->belongsToMany(Role::class);
    }

    public function hasPermission(Permission $permission ){

        return $this->hasAnyRoles($permission->roles);

    }

    public function hasAnyRoles($roles){



        return $this->papels->contains('gestor');
    }
}
