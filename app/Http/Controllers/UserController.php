<?php

namespace GameReel\Http\Controllers;

use GameReel\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'gamertag' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        return User::create($request->all());
    }
}
