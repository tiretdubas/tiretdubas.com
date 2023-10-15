<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Post */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'body' => $this->when(isset($this->body), fn () => markdown_to_html($this->body)),
            'created_at' => $this->created_at,
            'created_at_for_muggles' => $this->created_at?->translatedFormat('d F Y'),
            'updated_at' => $this->updated_at,
        ];
    }
}
