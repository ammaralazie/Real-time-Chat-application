<?php

namespace App\Http\Controllers\ChatApp;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        return view('home');
    }//end of index

    public function getUser(){
        $obj=User::latest()->paginate(2);
        return response()->json($obj);
    }//end of get User

    public function getSearchUser($value){
        $users=User::where(function($q) use($value){
            return $q->where('username','like','%'.$value.'%');
        })->latest()->get();//end of users obj
        if($value == '*.*'){
            $users=User::latest()->get();
        }
        return response()->json($users);
    }//end of getSearchUser
}
