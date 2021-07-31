<?php

namespace App\Http\Controllers\ChatApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        return response()->json(['msg'=>'welocm in home page']);
    }//end of index
}
