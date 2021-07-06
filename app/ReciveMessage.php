<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReciveMessage extends Model
{
    protected $guarded=[];

    public function messages()
    {
        return $this->hasMany(Message::class);
    } //end of messages

    public function users()
    {
        return $this->belongsTo(User::class);
    } //end of users
}
