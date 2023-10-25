<?php

namespace Tests\Feature\Controllers;

use App\Models\Information;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_a_successful_response(): void
    {
        $this->get('/')
            ->assertOk();
    }

    public function test_index_can_have_an_optionnal_catchblock(): void
    {
        $this->get('/')
            ->assertInertia(fn (Assert $page) => $page
                ->has('catchblock', null)
            );

        $catchblock = Information::create([
            'key' => 'posts',
            'value' => '# Hello everyone',
        ]);

        $this->get('/')
            ->assertInertia(fn (Assert $page) => $page
                ->has('catchblock', fn (Assert $page) => $page
                    ->where('value', markdown_to_html($catchblock->value))
                )
            );
    }

    public function test_index_gets_only_published_posts(): void
    {
        Post::factory(2, [
            'status' => 'Published',
        ])->create();

        $this->get('/')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Post/Index')
                ->has('posts', 2, fn (Assert $page) => $page
                    ->hasAll([
                        'id',
                        'title',
                        'slug',
                        'excerpt',
                        'published_at',
                        'published_at_for_muggles',
                    ])
                )
            );
    }

    public function test_index_does_not_show_draft_or_archived_posts(): void
    {
        Post::factory([
            'status' => 'Draft',
        ])->create();

        Post::factory([
            'status' => 'Archived',
        ])->create();

        $this->get('/')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Post/Index')
                ->has('posts', 0)
            );
    }

    public function test_show_returns_a_successful_response_for_published_posts(): void
    {
        $post = Post::factory([
            'status' => 'Published',
        ])->create();

        $this->get('/articles/'.$post->slug)
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Post/Show')
                ->has('post', fn (Assert $page) => $page
                    ->where('id', $post->id)
                    ->hasAll([
                        'title',
                        'slug',
                        'body',
                        'excerpt',
                        'published_at',
                        'published_at_for_muggles',
                        'updated_at',
                    ])
                )
            );
    }

    public function test_show_returns_a_not_found_response_for_draft_and_archived_posts(): void
    {
        $draftPost = Post::factory([
            'status' => 'Draft',
        ])->create();

        $archivedPost = Post::factory([
            'status' => 'Archived',
        ])->create();

        $this->get('/articles/'.$draftPost->slug)
            ->assertNotFound();

        $this->get('/articles/'.$archivedPost->slug)
            ->assertNotFound();
    }
}
