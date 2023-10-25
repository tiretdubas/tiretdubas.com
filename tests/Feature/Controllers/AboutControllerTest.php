<?php

namespace Tests\Feature\Controllers;

use App\Models\Information;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AboutControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_a_successful_response_with_information(): void
    {
        Information::create([
            'key' => 'about',
            'value' => '# Hello everyone',
        ]);

        $this->get('/a-propos')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('About')
                ->has('about', fn (Assert $page) => $page
                    ->has('value')
                )
            );
    }

    public function test_returns_a_not_found_response_when_no_information(): void
    {
        $this->get('/a-propos')
            ->assertNotFound();
    }
}
