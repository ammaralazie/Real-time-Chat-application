<?php

namespace App\Http\Controllers\ChatApp;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('global:api')
            ->except([
                'index',
                'getUser',
                'getSearchUser',
                'signup',
                'login'
            ]);
    }


    //this function only to handle home page
    public function index(Request $request)
    {
        return view('home');
    } //end of index

    //this function to register user
    public function signup(Request $request)
    {

        $vldate = Validator::make($request->all(), [
            "username" => ['required', 'string', 'unique:users,username'],
            "email" => ['required', 'email', 'unique:users,email'],
            "password" => ['required', 'confirmed']
        ]);

        if ($vldate->fails()) {
            return response()->json([
                'token' => null,
                'data' => null,
                'state' => '404',
                'err' => $vldate->errors()->first()
            ]);
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = Auth::guard('api')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json([
            'token' => $token,
            'data' => Auth::guard('api')->user(),
            'state' => '200',
            'err' => null
        ]);
    } //end of signup

    //this function to login user
    public function login(Request $request)
    {

        //this to check this value is email or username
        $value = $request->identfy;
        $field = filter_var($value, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $value]);

        if ($field == 'username') {
            $vldate = Validator::make($request->all(), [
                'username' => ['required', 'exists:users,username'],
                "password" => ['required']
            ]);
        } else {
            $vldate = Validator::make($request->all(), [
                'email' => ['required', 'exists:users,email'],
                "password" => ['required']
            ]);
        } //end of if
        if ($vldate->fails()) {
            return response()->json([
                'token' => null,
                'data' => null,
                'state' => '404',
                'err' => $vldate->errors()->first()
            ]);
        } //end of if


        if ($field == 'username') {
            $token = Auth::guard('api')->attempt( ['username' => $request->username,  'password' => $request->password]);
        } else {
            $token=Auth::guard('api')->attempt(['email' => $request->email,  'password' => $request->password]);
        }



        if($token){
            return response()->json([
                'token' => $token,
                'data' => Auth::guard('api')->user(),
                'state' => '200',
                'err' => null
            ]);
        }else{
            return response()->json([
                'token' => null,
                'data' => null,
                'state' => '404',
                'err' => 'something is worng'
            ]);
        }

    } //end of login

    //this function to loguot user
    public function logout(Request $request){
        $token=$request->header('auth-token');
        if($token){
            try{
                JWTAuth::setToken($token)->invalidate();
                return response()->json([
                    'token' => 'invalidate token',
                    'data' => 'user was logout',
                    'state' => '200',
                    'err' =>null
                ], 404);
            }catch(\Exception $e){
                return response()->json
                ([
                    'token' => null,
                    'data' => null,
                    'state' => '404',
                    'err' => 'something is worng'
                ]);
            }//end try and catch
        }else{
            return response()->json
            ([
                'token' => null,
                'data' => null,
                'state' => '404',
                'err' => 'something is worng'
            ]);
        }//end of if
    }//end of logout function

    //this function to returen all user
    public function getUser()
    {
        $obj = User::latest()->paginate(2);
        return response()->json($obj);
    } //end of get User

    //this function to retern seraching user
    public function getSearchUser($value)
    {
        $users = User::where(function ($q) use ($value) {
            return $q->where('username', 'like', '%' . $value . '%');
        })->latest()->take(10)->get(); //end of users obj
        if ($value == '*.*') {
            return redirect()->route('user.getUser');
        }
        return response()->json($users);
    } //end of getSearchUser
}
