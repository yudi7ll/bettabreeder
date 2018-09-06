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
        return $this->hasMany(Auctions::class, 'users_id');
    }

    // Userinfo relationship
    public function userinfo()
    {
        // User has one relationship with Userinfo
        return $this->hasOne(Userinfo::class, 'users_id');
    }

    // User bids relationship
    public function userbids()
    {
        return $this->hasMany(Bid::class, 'users_id');
    }

    // User comment relationship
    public function comments()
    {
        return $this->hasMany(Comments::class, 'users_id');
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
