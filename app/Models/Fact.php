<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
// use LaravelInteraction\Vote\Concerns\Voteable;
// use LaravelInteraction\Bookmark\Concerns\Bookmarkable;

class Fact extends Model
{
    use HasFactory;
    // use Voteable;
    // use Bookmarkable;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeTrending($query)
    {
        return $query
            ->where('status', 'published')
            ->withCount('upvoters')
            ->withCount('downvoters')
            ->orderByRaw('(upvoters_count - downvoters_count) DESC')
            ->limit(3);
    }

    public function scopeNewFacts($query)
    {
        return $query
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(3);
    }
}
