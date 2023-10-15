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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeCollection(Builder $query): void
    {
        $query->select('id', 'title', 'slug', 'excerpt', 'created_at');
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new PublishedScope);

        static::saving(function (Post $post) {
            $post->excerpt = markdown_to_excerpt($post->body);
        });
    }
}
