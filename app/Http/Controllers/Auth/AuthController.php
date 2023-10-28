<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Auth;
class AuthController extends Controller{

    public function login(Request $request){
        $validator = Validator::make(request()->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validator->fails()) {
            return \App\Helper\ResponseBuilder::json($validator->errors()->first(), null, 422, $validator->errors());
        }
        $user = User::where(['email' => request('email')])->first();
        if (empty($user)) {
            return \App\Helper\ResponseBuilder::json('Your email does not exist in our records.', null, 422);
        }
        if (!Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            return \App\Helper\ResponseBuilder::json('Your credentials does not match our records.', null, 422);
        }
        $token = $user->createToken('laravelTestToken')->plainTextToken;
        return \App\Helper\ResponseBuilder::json('User Logged In Successfully', $token, 200);
    }

}