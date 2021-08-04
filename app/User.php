<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;


    protected $fillable = [
        'username', 'email', 'file', 'password',
    ];
    protected $appends = ['img',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImgAttribute(){
        return asset('media/'.$this->file);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }//end of messages

    public function reciveUser(){
        return $this->hasMany(ReciveMessage::class);
    }//end of reciveUser


    //this two function for JWT
    //----------------------------------//
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    //----------------------------------//
}
