<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{

    // mutating date 
    protected $dates = ['birth'];
    
    // Mass assigment
    protected $fillable = [
        'cover','seller_code','gender','address',
        'city','zip','country','telp','birth',
    ];

    // user 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
