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

    // User has many to Auctions
    public function auctions()
    {
        return $this->hasMany(Auctions::class);
    }

    // Userinfo relationship
    public function userinfo()
    {
        // User has one relationship with Userinfo
        return $this->hasOne(Userinfo::class, 'users_id')->first();
    }

    // updating user name
    public function scopeUpdateName($query)
    {
        request()->validate([
            'name' => 'required|string|max:255'
        ]);
        return $this->update(request(['name']));
    }
}
