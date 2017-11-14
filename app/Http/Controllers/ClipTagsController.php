<?php

namespace GameReel\Http\Controllers;

use GameReel\Models\Clip;
use GameReel\Models\Tag;
use Illuminate\Http\Request;

class ClipTagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $clip = Clip::where('uuid', $id)->where('user_id', auth()->id())->first();
        if (!$clip) {
            $clip = new Clip();
            $clip->uuid = $id;
            $clip->user_id = auth()->id();
            $clip->save();
        }
        $clip->syncTags($request->input('tags'));
        $clip->load('tags');
        $tags = Tag::withClipCount()->get();

        return response()->json(compact('clip', 'tags'));
    }
}
