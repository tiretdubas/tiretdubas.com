<?php

use Illuminate\Support\Str;
use Spatie\LaravelMarkdown\MarkdownRenderer;

if (! function_exists('markdown_to_html')) {
    function markdown_to_html(string $markdown): string
    {
        return app(MarkdownRenderer::class)->toHtml($markdown);
    }
}

if (! function_exists('markdown_to_excerpt')) {
    function markdown_to_excerpt(string $markdown, int $limit = 250): string
    {
        return Str::limit(strip_tags(markdown_to_html($markdown)), $limit);
    }
}
