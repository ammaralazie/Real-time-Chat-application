<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id', 'content', 'state'];

    public function sendUser()
    {

        return $this->belongsTo(User::class);
    } //end of sendUser

    public function reciveUser()
    {

        return $this->hasOne(ReciveMessage::class);
    } //end of reciveUser

}
