<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $filebale=['message'];

    public function user(){

        return $this->belongsTo(User::class);

    }//end of user function
}
