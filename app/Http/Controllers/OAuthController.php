<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Validator;
use Auth;

class OAuthController extends Controller
{
    public function authorize_user(Request $request) {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json($validator->messages(), 400);
        }

        $credentials = ['email' => $request->email, 'password' => $request->password, 'active'=>1];

        if (Auth::attempt($credentials)) { 
            $query = http_build_query([
                'client_id' => 'client-id',
                'redirect_uri' => env('APP_URL').'/api/capsules',
                'response_type' => 'token',
                'scope' => '',
                'state' => Str::random(40),
            ]);
         
            return redirect(env('APP_URL').'/oauth/authorize?'.$query);
        }

        else return response()->json(['result'=> false], 200);
    }
}
