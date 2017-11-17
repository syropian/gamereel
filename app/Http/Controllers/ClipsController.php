<?php

namespace GameReel\Http\Controllers;

use Zttp\Zttp;
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

    public function update(Request $request)
    {
        $dropboxToken = auth()->user()->dropbox_token;
        $clipId = $request->input('id');
        $clipUrl = $request->input('url');
        return Zttp::withHeaders([
                'Authorization' => "Bearer {$dropboxToken}",
                'Content-Type' => 'application/json',
            ])
            ->post('https://api.dropboxapi.com/2/files/save_url', [
                'path' => "/{$clipId}.mp4",
                'url' => $clipUrl
            ])
            ->json();
    }
}
