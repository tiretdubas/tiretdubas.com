<?php

namespace Tests\Unit\Enums;

use App\Enums\Status;
use Tests\TestCase;

class StatusTest extends TestCase
{
    public function test_gets_cases_names(): void
    {
        $names = Status::names();

        $this->assertSame(['Draft', 'Published', 'Archived'], $names);
    }

    public function test_gets_colors(): void
    {
        $colors = [
            Status::color('Draft'),
            Status::color('Published'),
            Status::color('Archived'),
        ];

        $this->assertSame(['gray', 'success', 'warning'], $colors);
    }

    public function test_gets_translations(): void
    {
        $translations = Status::arrayWithTranslations();

        $expected = [
            'Draft' => __('Status.Draft'),
            'Published' => __('Status.Published'),
            'Archived' => __('Status.Archived'),
        ];

        $this->assertSame($expected, $translations);
    }
}
