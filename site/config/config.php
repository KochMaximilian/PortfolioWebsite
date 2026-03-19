<?php

return [
    'debug'            => false,
    'home'             => 'projects',

    'routes' => [
        [
            'pattern' => 'robots.txt',
            'action'  => function () {
                $content  = "User-agent: *\n";
                $content .= "Allow: /\n\n";
                $content .= "# Disallow CMS panel and internal paths\n";
                $content .= "Disallow: /panel\n";
                $content .= "Disallow: /kirby/\n";
                $content .= "Disallow: /site/\n";
                $content .= "Disallow: /content/\n\n";
                $content .= "Sitemap: " . site()->url() . "/sitemap.xml\n";

                return new Kirby\Http\Response($content, 'text/plain', 200);
            }
        ],
        [
            'pattern' => 'sitemap.xml',
            'action'  => function () {
                $pages = site()->index()->listed();
                $content = '<?xml version="1.0" encoding="UTF-8"?>';
                $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

                // Add homepage
                $content .= '<url>';
                $content .= '<loc>' . site()->url() . '</loc>';
                $content .= '<changefreq>weekly</changefreq>';
                $content .= '<priority>1.0</priority>';
                $content .= '</url>';

                foreach ($pages as $p) {
                    // Skip the homepage — already added above
                    if ($p->isHomePage()) continue;

                    $priority = '0.5';
                    $changefreq = 'monthly';

                    if ($p->intendedTemplate()->name() === 'project') {
                        $priority = '0.8';
                    } elseif ($p->intendedTemplate()->name() === 'about') {
                        $priority = '0.7';
                    }

                    $content .= '<url>';
                    $content .= '<loc>' . $p->url() . '</loc>';
                    $content .= '<lastmod>' . $p->modified('c') . '</lastmod>';
                    $content .= '<changefreq>' . $changefreq . '</changefreq>';
                    $content .= '<priority>' . $priority . '</priority>';
                    $content .= '</url>';
                }

                $content .= '</urlset>';

                return new Kirby\Http\Response($content, 'application/xml', 200);
            }
        ],
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