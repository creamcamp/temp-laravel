<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function index(Request $request)
    {
        request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $authData = array(
            'email'=> $request->get('email'),
            'password'=> $request->get('password')
        );

        if (Auth::attempt($authData))
        {
            $userId = User::select('id')->where('email', $authData['email'])->first();

            return response()->json([
                'status'=> 200,
                'email'=> $authData['email'],
                'uID'=> $userId['id'],
                'success'=> true,
            ]);
        } else {
            return response()->json([
                'status'=> 404,
                'email'=> null,
                'uID'=> null,
                'success'=> false,
                'error'=> '404 User not found!',
                'message'=> 'Unable to find this user!'
            ]);
        }
    }
}
