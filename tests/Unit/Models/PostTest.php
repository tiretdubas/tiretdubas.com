<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_sets_published_at_only_with_published_status(): void
    {
        $post = Post::factory([
            'status' => 'Draft',
            'published_at' => null,
        ])->create();

        $post->update([
            'status' => 'Draft',
        ]);

        $post->update([
            'status' => 'Archived',
        ]);

        $this->assertNull($post->published_at);

        $post->update([
            'status' => 'Published',
        ]);

        $this->assertNotNull($post->published_at);
    }

    public function test_published_at_does_not_change_when_already_set(): void
    {
        $post = Post::factory([
            'status' => 'Published',
            'published_at' => now()->subMinute(),
        ])->create();

        $post->status = 'Published';
        $post->save();

        $this->assertFalse($post->wasChanged('published_at'));
    }
}
