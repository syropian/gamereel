<?php

namespace GameReel\Http\Controllers;

use JWTAuth;
use GameReel\Models\User;
use GameReel\Lib\XboxClient;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $gamertag = $request->input('gamertag');
        $client = new XboxClient($gamertag, config('services.xbox_api.key'));
        $xuid = $client->getXuid();
        
        $user = User::create($request->validate([
            'gamertag' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]));

        $user->update(['xuid' => $xuid]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'));
    }
}
