<?php

namespace GameReel\Http\Controllers;

use GameReel\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function index()
    {
        return Tag::withClipCount()->get();
    }
}
