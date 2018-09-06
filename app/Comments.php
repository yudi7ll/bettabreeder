<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'auctions_id', 'content'
    ];
    
    // Belongs to User relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Belongs to Auction Page relationship
    public function auction()
    {
        return $this->belongsTo(Auctions::class, 'auctions_id');
    }
}
