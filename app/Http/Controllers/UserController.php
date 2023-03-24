<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function register(Request $req){
        $req->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'confirmPassword' => 'required|same:password'
        ]);
        $user = new User();
        $user->name =$req->input('name');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password'));
        $result = $user->save();

        if($result){
            return ["Result"=>"Account successfully registered"];
        }
        else{
            return ["Result"=>"Operation Failed"];
        }
    }

    function login(Request $req){
        $user = User::where('email', $req->email)->first();
        if(!$user || !Hash::check($req->password, $user->password)){
            return response([
                'message'=>['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }

    function logout(Request $req){
        Auth::logout();
        return redirect()->intended('dashboard');
    }
}
