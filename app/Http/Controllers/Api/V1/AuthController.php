<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = validator::make($request->all(),
            [
                "name" => "required",
                "email" => "required|unique:users",
                "password" => "required|confirmed",
            ]
        );

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "message" => $validator->messages()
            ],422);
        }

        $post = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return [
            "status" => true,
            'post' => $post,
            'message'=> ' you registered'
        ];

    }
    public function login(Request $request)
    {
        $validator = validator::make($request->all(),
            [
                "email" => "required",
                "password" => "required",
            ]
        );
        if($validator->fails()){
            return response()->json([
                "status" => false,
                "message" => $validator->messages()
            ],422);
        }

      if(Auth::attempt(($request->only('email','password')))){
          return response()->json([
                Auth::user(),
               "status" => true,
          ]);
      }


    }
    public function logout()
    {
        Auth::logout();
    }

}
