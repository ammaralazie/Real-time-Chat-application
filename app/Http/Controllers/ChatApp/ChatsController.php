<?php

namespace App\Http\Controllers\ChatApp;

use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function messages_users()
    {

        $authUser = Auth::user();

        $users = User::whereHas('reciveUser', function ($q) use ($authUser) {
            return $q->where('user_id', $authUser->id);
        })->get();

        $sndUsr = [];
        foreach ($users->first()->reciveUser as $item) {
            $msg = Message::find($item->message_id);
            $sndUsr[$item->id] = User::findOrFail($msg->user_id);
        } //end of foreach

        foreach ($sndUsr as $key => $item) {
            foreach ($sndUsr as $ky => $itm) {
                if ($key == $ky) {
                    continue;
                }
                if ($item == $itm) {
                    $sndUsr[$item->id] = '';
                } //end of if
            } //end of forech itm
        } //end of foreach item
        $sndUsr = array_filter($sndUsr);
        //  dd($sndUsr);
        return view('message.messages', compact('sndUsr'));
    } //end of messages_users


    public function message_user($username){
        return view('message.my_you');
    }//end of message_user
}
