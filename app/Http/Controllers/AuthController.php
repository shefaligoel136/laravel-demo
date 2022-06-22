<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'email' => ['required','email',Rule::unique('users','email')],
            'password' => ['required','min:6'],
        ]);
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'password' => Hash::make($request->input('password'))
        ]);
    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response([
                'message' => 'Invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        /** @var \App\Models\MyUserModel $user **/
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 24); // 1 day

        return response([
            'message' => 'Token is -> ' . $token . ' successfully logged in'
        ])->withCookie($cookie);
    }

    public function me(){
        return Auth::user();
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'Successfully logged out'
        ])->withCookie($cookie);
    }
}
