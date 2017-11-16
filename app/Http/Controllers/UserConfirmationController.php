<?php

namespace GameReel\Http\Controllers;

use GameReel\Models\User;
use Illuminate\Http\Request;

class UserConfirmationController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('confirmation_token', $request->input('token'))->first();
        if (!$user) {
            return 'Invalid confirmation token.';
        }
        $user->confirm();
        
        return redirect('/?email_confirmed=true');
    }
}
