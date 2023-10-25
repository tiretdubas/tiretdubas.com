<?php

namespace Tests\Unit;

use Tests\TestCase;

class HelpersTest extends TestCase
{
    protected static string $plainText;

    protected static string $markdown;

    protected static string $html;

    public static function setUpBeforeClass(): void
    {
        static::$plainText = (string) file_get_contents(static::assetsPath('/markdown/excerpt.txt'));
        static::$markdown = (string) file_get_contents(static::assetsPath('/markdown/post.md'));
        static::$html = (string) file_get_contents(static::assetsPath('/markdown/post.html'));
    }

    public function test_markdown_to_html(): void
    {
        $this->assertSame(static::$html, markdown_to_html(static::$markdown));
    }

    public function test_markdown_to_excerpt(): void
    {
        $this->assertSame(static::$plainText, markdown_to_excerpt(static::$markdown));
    }
}
