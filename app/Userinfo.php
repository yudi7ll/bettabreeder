<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Userinfo extends Model
{

    // Mass assigment
    protected $fillable = [
        'cover','seller_code','gender','address',
        'city','zip','country','telp',
    ];

    // Userinfo is belongsTo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // validation request
    public function scopeUserinfoValidate($query)
    {
        return request()->validate([
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'zip' => 'nullable|max:50',
            'country' => 'required|string|max:20',
            'telp' => 'required|max:100'
        ]);
    }


    // update userinfo
    public function scopeUserinfoUpdate($query)
    {
        return $this->update(request(['gender', 'address', 'city', 'zip', 'country', 'telp']));
    }

}
