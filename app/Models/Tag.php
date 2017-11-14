<?php

namespace GameReel\Models;

use JWTAuth;
use GameReel\Lib\TagSlugger;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['pivot', 'user_id'];

    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clips()
    {
        return $this->belongsToMany(Clip::class);
    }

    public function scopeWhereName($query, $name)
    {
        return $query->where('name', $name)->where('user_id', auth()->id());
    }

    public function scopeWithClipCount($query)
    {
        return $query->withCount('clips')->where('user_id', auth()->id())->orderBy('sort_order', 'asc');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            JWTAuth::parseToken()->authenticate();
            $tag->user_id = auth()->id();
            $tag->sort_order = self::where('user_id', auth()->id())->count();
            $tag->slug = (new TagSlugger($tag->name))->fix();
        });

        static::saving(function ($tag) {
            $tag->slug = (new TagSlugger($tag->name))->fix();
        });
    }
}
