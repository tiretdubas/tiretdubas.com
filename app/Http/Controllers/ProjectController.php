<?php

namespace App\Http\Controllers;

use App\Http\Resources\InformationResource;
use App\Http\Resources\ProjectResource;
use App\Models\Information;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): Response
    {
        return Inertia::render(
            'Project',
            [
                'catchblock' => new InformationResource(
                    Information::select('value')->where('key', 'projects')->first()
                ),
                'projects' => ProjectResource::collection(
                    Project::latest()->get()
                ),
            ]
        );
    }
}
