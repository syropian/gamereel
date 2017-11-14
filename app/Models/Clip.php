<?php

namespace GameReel\Models;

use Illuminate\Database\Eloquent\Model;

class Clip extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function syncTags($tags = [])
    {
        $ids = [];
        if (empty($tags)) {
            $this->tags()->sync([]);
        } else {
            foreach ($tags as $tag) {
                $name = strtolower($tag['name']);
                $userTag = Tag::whereName($name)->first();
                if (!$userTag) {
                    $userTag = Tag::create(['name' => $name]);
                }
                array_push($ids, $userTag->id);
                $this->tags()->sync($ids);
            }
        }
    }
}
