<?php

namespace App\Http\Controllers\ChatApp;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Message;
use App\ReciveMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class ChatsController extends Controller
{
    public function messages_users()
    {
        try{
            $authUser = Auth::user();

            //take my id which found in table create_recive_messages_table
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
                        $sndUsr[$key] = '';
                    } //end of if
                } //end of foreach itm
            } //end of foreach item
            $sndUsr = array_reverse(array_filter($sndUsr));

            return view('message.messages', compact('sndUsr'));

        }catch(\Exception $e){
            $sndUsr=[];
            return view('message.messages',compact('sndUsr'));
        }

           } //end of messages_users


    public function message_user($username){

        $usr_id=User::where('username',$username)->first();
        $recive_usr=ReciveMessage::where('user_id',$usr_id->id)->get();
        $all_msg=[];
        //this section for meesage reciveing by username
        foreach($recive_usr as $key=>$item){
            $snd_usr=User::find(Message::find($item->message_id)->user_id);
            if($snd_usr ==auth()->user()){
                $all_msg[$key]=Message::where('id',$item->message_id)->get();
            }//end of if
        }//end of foreach

        //this section for meesage sending from username to me
         $recive_usr=ReciveMessage::where('user_id',auth()->user()->id)->get();
         $count=count($all_msg);
         foreach($recive_usr as $key=>$item){
            $snd_usr=User::find(Message::find($item->message_id)->user_id);

            if($snd_usr ==$usr_id){
                $all_msg[$count ++]=Message::where('id',$item->message_id)->get();
            }//end of if
        }//end of foreach

        //for sort by created_at

        //dd($all_msg,$all_msg[1]);
          $all_msg=(object)array_reverse($all_msg);;


        return view('message.my_you',compact('all_msg','usr_id'));
    }//end of message_user

    public function recive_message(Request $request){
        if($request){
            $vldt=Validator::make($request->all(),[
                'message'=>'string|required',
                'reciveUsr'=>'required|exists:users,id',
                'sendUsr'=>'required|exists:users,id'
            ]);//end of validator

            if($vldt->fails()){
                return response()->json(['msg'=> $vldt->errors()->first()]);
            }//end of if

            //create mesage
            $sndUsr=User::find($request->sendUsr);
            if($sndUsr){
                $createMsg=Message::create([
                    'user_id'=>$sndUsr->id,
                    'content'=>$request->message,
                ]);
            }//end of if

            //send message to recive user
            $reciver=User::find($request->reciveUsr);
            if ($reciver and $createMsg){
                $link=[
                    'user_id'=>$reciver->id,
                    'message_id'=>$createMsg->id,
                ];
                $recv=ReciveMessage::create($link);
            }//end of if

            //make event to ChatEvent
            event(new ChatEvent($createMsg->content,$sndUsr->id,$recv->user_id));

            return response()->json(['msg'=>'successfly']);

        }else{
            return response()->json(['msg'=>'check your message and try agine']);
        }
    }//end of recive_message

    public function showMessage(){
        return view('message.my_you');
    }
}//end of ChatsController
