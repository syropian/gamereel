<?php

namespace GameReel\Http\Controllers;

use Socialite;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class DropboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['store']]);
    }

    public function index(Request $request)
    {
        $request->session()->put('jwt', $request->input('token'));
        return Socialite::with('dropbox')->redirect();
    }

    public function store(Request $request)
    {
        $jwt = $request->session()->get('jwt');
        JWTAuth::setToken($jwt)->authenticate();
        $dropboxUser = Socialite::driver('dropbox')->user();
        $user = auth()->user();
        $user->dropbox_token = $dropboxUser->token;
        $user->save();
        $request->session()->forget('jwt');
        
        return redirect('/dashboard');
    }
}
