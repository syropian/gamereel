<?php

namespace GameReel\Http\Controllers;

use GameReel\Models\Clip;
use Illuminate\Http\Request;

class ClipsController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function index()
    {
        return Clip::with('tags')->where('user_id', auth()->id())->get();
    }
}
