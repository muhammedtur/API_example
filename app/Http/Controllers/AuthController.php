<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use Validator;

/**
 * @OA\Get(
 *     path="/auth",
 *     @OA\Response(response="200", description="Auth API Documentation")
 * )
 */

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json($validator->messages(), 400);
        }

        $credentials = ['email' => $request->email, 'password' => $request->password, 'active' => 1];

        if (!Auth::attempt($credentials, $request->remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function clients(Request $request)
    {
        return view('clients',['clients'=>$request->user()->clients]);
    }
}
