<?php

namespace App\Models;

use App\Models\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'status',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeCollection(Builder $query): void
    {
        $query->select('id', 'title', 'slug', 'excerpt', 'published_at');
    }

    public function scopeLatestPublished(Builder $query): void
    {
        $query->orderBy('published_at', 'desc');
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new PublishedScope);

        static::saving(function (Post $post) {
            $post->excerpt = markdown_to_excerpt($post->body);
            if ($post->status === 'Published' && $post->published_at === null) {
                $post->published_at = now();
            }
        });
    }
}
