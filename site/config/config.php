<?php

return [
    'debug'            => true,
    'home'             => 'projects',

    'routes' => [
        [
            'pattern' => 'download/cv',
            'action'  => function () {
                $about = page('about');
                $cv    = $about ? $about->files()->template('cv')->first() : null;

                if (!$cv) {
                    return site()->visit('error');
                }

                return new Kirby\Http\Response(
                    F::read($cv->root()),
                    'application/pdf',
                    200,
                    [
                        'Content-Disposition' => 'attachment; filename="' . $cv->filename() . '"',
                        'Cache-Control'       => 'no-cache, must-revalidate',
                        'X-Content-Type-Options' => 'nosniff',
                    ]
                );
            }
        ]
    ]
];