<?php

namespace Tests\Feature\Controllers;

use App\Models\Information;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_a_successful_response(): void
    {
        $this->get('/projets')
            ->assertOk();
    }

    public function test_can_have_an_optionnal_catchblock(): void
    {
        $this->get('/projets')
            ->assertInertia(fn (Assert $page) => $page
                ->has('catchblock', null)
            );

        $catchblock = Information::create([
            'key' => 'projects',
            'value' => '# Hello everyone',
        ]);

        $this->get('/projets')
            ->assertInertia(fn (Assert $page) => $page
                ->has('catchblock', fn (Assert $page) => $page
                    ->where('value', markdown_to_html($catchblock->value))
                )
            );
    }

    public function test_gets_projects(): void
    {
        Project::factory(5)->create();

        $this->get('/projets')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Project')
                ->has('projects', 5, fn (Assert $page) => $page
                    ->hasAll([
                        'id',
                        'name',
                        'description',
                        'url',
                        'label',
                        'icon',
                        'alt',
                        'created_at',
                        'updated_at',
                    ])
                )
            );
    }
}
