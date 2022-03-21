<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Lockout;

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

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            event(new Lockout($request));
        }

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
