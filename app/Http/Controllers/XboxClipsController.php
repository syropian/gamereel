<?php

namespace GameReel\Http\Controllers;

use GameReel\Lib\XboxClient;
use GameReel\Models\Clip;
use Illuminate\Http\Request;

class XboxClipsController extends Controller
{
    protected $client;
    
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function index()
    {
        $this->client = new XboxClient(auth()->user()->gamertag, config('services.xbox_api.key'));
        $clips = $this->client->getClips(auth()->user()->xuid);
        $clips = array_map(function ($clip) {
            $clip['tags'] = [];
            return $clip;
        }, $clips);
        
        return response()->json(compact('clips'));
    }
}
