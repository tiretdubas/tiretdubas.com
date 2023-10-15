<?php

namespace App\Http\Controllers;

use App\Http\Resources\InformationResource;
use App\Models\Information;
use Inertia\Inertia;
use Inertia\Response;

class AboutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): Response
    {
        return Inertia::render(
            'About',
            [
                'about' => new InformationResource(
                    Information::select('value')->where('key', 'about')->firstOrFail()
                ),
            ]
        );
    }
}
