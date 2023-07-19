<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $request['type'] = 0;
        $request['status'] = "unlock";
        $user = User::create($request->toArray());

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $newFileName = time() . '.' . $extension;
            $image->move(public_path('avatars'), $newFileName);
            $request['avatar'] = $newFileName;
            $user->avatar = $newFileName;
        }

    
        
        $user->update();
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];


        return response(['access_token' => $response, 'user' => $user], 200);
    }


    public function login(Request $request)
    { // si le champ => unlock else renvoie un message  =>logout()
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();


        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response(['access_token' => $response, 'user' => $user], 200);
            } else {
                $response = ["message" => "mot de passe incorrecte"];
                return response()->json($response, 422);
            }
        } else {
            $response = ["message" => 'ce compte n\'exite pas'];
            return response()->json($response, 422);
        }
    }


    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function user()
    {
        $user = User::find(Auth::user()->id);

        return response()->json([$user]);
    }
}
