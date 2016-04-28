<?php

namespace Furbook;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Furbook\Cat;

class User extends Authenticatable implements AuthenticableContract, CanResetPasswordContract
{
    protected $casts = [
        'is_admin' => 'boolean'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cats()
    {
        return $this->hasMany(Cat::class);
    }

    public function owns(Cat $cat)
    {
        return $this->id == $cat->user_id;
    }

    public function canEdit(Cat $cat)
    {
        return $this->is_admin || $this->owns($cat);
    }

    public function isAdministrator()
    {
        return $this->getAttribute('is_admin');
    }
}
