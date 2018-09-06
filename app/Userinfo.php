<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;
use File;

class Userinfo extends Model
{

    // Mutate to Carbon date
    protected $dates = ['lastActivity'];
    
    // Mass assigment
    protected $fillable = [
        'cover','seller_code','gender','address',
        'city','zip','country','telp', 'users_id', 'lastActivity'
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
            'address' => 'required|string|max:255',
            'gender' => 'required|string',
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

    // Update Profile Picture
    public function scopeCoverUpdate($query)
    {
        // user
        $user = Auth::user();
        // request image
        $image = request()->cover;

        /**
         * $type :@return data:image/png
         * $image :@return base64,
         */
        list($type, $image) = explode(';', $image);
        $image = explode(',', $image)[1];

        // decode the image
        $image = base64_decode($image);
        
        // image name using username+time()
        $imageName = $user->name.time().'.png';
        $path = public_path('images/');
        
        // delete old image
        $userCover = $user->userinfo->cover;
        if($userCover != 'no-image.png'){
            File::delete($path.$userCover);
        }
        
        // insert new imageName into database
        $this->where('users_id', $user->id)
             ->update([
                 'cover' => $imageName
             ]);
        
        // save into $path        
        return file_put_contents($path.$imageName, $image);
    }

    /**
     * User Online Status
     * @return users_id
     */
    public function scopeUserStatus()
    {
        $userOnline = [];
        foreach($this->get() as $userStatus){
            if($userStatus->lastActivity > \Carbon\Carbon::now()){
                $userOnline[] = $userStatus->users_id;
            }
        }
        return $userOnline;
    }
}
