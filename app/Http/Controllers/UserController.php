<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;




class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|',
            'email'=>'required|email|string|unique:users',
            'password'=>'required|string|min:6'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return response()->json([
            'message'=>'User registered successfully',
            'user'=>$user]);

    }
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|string',
            'password'=>'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        if(!$token = auth()->attempt($validator->validated())){
            return response()->json(['error'=>'Unauthorised User',401]);
        }
        return $this->createNewToken($token);

    }
    public function createNewToken($token){
        return response()->json([
          'access_token'=> $token,
          'token_type'=>'bearer',
          'expires_in'=>auth()->factory()->getTTL()*60,
          'user'=>auth()->user()
        ]);
    
    }
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|string|email',
    //         'password' => 'required|string',
    //     ]);
    //     $credentials = $request->only('email', 'password');

    //     $token = Auth::attempt($credentials);
    //     if (!$token) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Unauthorized',
    //         ], 401);
    //     }

    //     $user = Auth::user();
    //     return response()->json([
    //             'status' => 'success',
    //             'user' => $user,
    //             'authorisation' => [
    //                 'token' => $token,
    //                 'type' => 'bearer',
    //             ]
    //         ]);

    // }
    public function profile(Request $request){
        return response()->json(auth()->user());
    }
    public function logout(){
        auth()->logout();
        return response()->json([
            'message'=>'User logged out'
        ]);
    }
  
}
