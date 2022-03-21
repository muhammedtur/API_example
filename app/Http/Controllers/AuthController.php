<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

use Validator;

/**
 * @OA\Get(
 *     path="/auth",
 *     @OA\Response(response="200", description="Auth API Documentation")
 * )
 */

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();
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
