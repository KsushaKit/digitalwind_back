<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\User;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);
    
        $user = User::query()
            ->where('login', $request->login)
            ->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => [
                    'The provided credentials are incorrect.',
                ],
            ]);
        }
    
        $token = $user->createToken();
    
        $response = [
            'token' => $token,
            'id' => $user->id,
            'role' => $user->role
        ];
    
        return response()->json($response);
    }
}
