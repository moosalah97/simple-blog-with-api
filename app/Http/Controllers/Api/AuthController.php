<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    use ApiResponseTrait;
    //
    /*public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }*/

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),400);
        }else{


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $token = $user->createToken('Laravel-9-Passport-Auth')->accessToken;

            return $this->apiResponse( new UserResource($user),'this user created has token ' . $token ,201) ;
        }
    }

    /**
     * Login Req
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = auth()->user();
            $token =$user ->createToken('Laravel-9-Passport-Auth')->accessToken;

            return $this->apiResponse($user,"token is::->  ". $token ,201) ;
        } else {
            return $this->apiResponse(null,'unauthorized ' ,401) ;
        }
    }



    public function userProfile() {
        return $this->apiResponse( auth()->user(),'this user signed in ',201) ;
    }

   public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return $this->apiResponse( null,'this user signed out ',201) ;
    }




}
