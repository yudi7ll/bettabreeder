<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email','password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // user is belongs to auctions
    // @return Auctions
    public function auctions()
    {
        return $this->hasMany(Auctions::class);
    }

    // user info 
    public function userinfo()
    {
        return $this->hasOne(Userinfo::class, 'users_id')->first();
    }
}
