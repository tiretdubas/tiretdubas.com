<?php

namespace App\Http\Controllers;

use App\Http\Resources\InformationResource;
use App\Http\Resources\PostResource;
use App\Models\Information;
use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $catchblock = Information::select('value')->where('key', 'posts')->first();

        return Inertia::render(
            'Post/Index',
            [
                'catchblock' => $catchblock ? new InformationResource($catchblock) : null,
                'posts' => PostResource::collection(
                    Post::collection()->latestPublished()->get()
                ),
            ]
        );
    }

    public function show(Post $post): Response
    {
        return Inertia::render(
            'Post/Show',
            [
                'post' => new PostResource($post),
            ]
        );
    }
}
