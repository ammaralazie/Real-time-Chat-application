<?php

namespace App\Http\Controllers\ChatApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        return view('home');
    }//end of index
}
