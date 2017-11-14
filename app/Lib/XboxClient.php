<?php

namespace GameReel\Lib;

use Zttp\Zttp;
use Illuminate\Support\Facades\Cache;

class XboxClient
{
    protected $gamertag;
    protected $key;
    protected $root;
    
    public function __construct($gamertag, $key)
    {
        $this->gamertag = $gamertag;
        $this->key = $key;
        $this->root = 'https://xboxapi.com/v2';
    }

    public function getXuid()
    {
        return Zttp::withHeaders(['X-AUTH' => $this->key])->get("{$this->root}/xuid/{$this->gamertag}")->json();
    }

    public function getClips($xuid, $refresh = false)
    {
        // return Zttp::withHeaders(['X-AUTH' => $this->key])->get("{$this->root}/{$xuid}/game-clips/saved")->json();
        if (!$refresh) {
            $clips = Cache::remember("{$xuid}.clips", 60, function () use ($xuid) {
                return Zttp::withHeaders(['X-AUTH' => $this->key])->get("{$this->root}/{$xuid}/game-clips/saved")->json();
            });
            return $clips;
        } else {
            return Zttp::withHeaders(['X-AUTH' => $this->key])->get("{$this->root}/{$xuid}/game-clips/saved")->json();
        }
    }
}
