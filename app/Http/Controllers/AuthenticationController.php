<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function authenticate(Request $request) {
        
        $validation  = Validator::make($request->all(),[
            'email' => 'required|email',
            'password'=>'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'=> false,
                'error' => $validation->errors()
            ], 401);
        }
        else {
            $credentials = [
                'email'=> $request->email,
                'password'=> $request->password
            ];

            if(Auth::attempt($credentials))
            {
                $user = User::find(Auth::user()->id);
                $token = $user->createToken('Token')->plainTextToken;
                
                return response()->json([
                    'status'=> true,
                    'token' => $token,
                    'id' => Auth::user()->id
                ]);
            }
            else {
                return response()->json([
                    'status'=> false,
                    'error' => 'Invalid Credentials'
                ]);
            }
        }

    }

    public function logout()
    {
        $user=User::find(Auth::user()->id);
        $user->tokens()->delete();

        return response()->json([
            'status'=> true,
            'message' => 'Logout Successfully'
        ]);
    }
}
