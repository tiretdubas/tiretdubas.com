<?php

// Some information to register in the "information" table

return [
    [
        'key' => 'posts',
        'value' => file_get_contents(database_path('/seeders/markdown/posts.md')),
    ],
    [
        'key' => 'projects',
        'value' => file_get_contents(database_path('/seeders/markdown/projects.md')),
    ],
    [
        'key' => 'about',
        'value' => file_get_contents(database_path('/seeders/markdown/about.md')),
    ],
];
