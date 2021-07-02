<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
}
