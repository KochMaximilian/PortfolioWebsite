# Game Design Portfolio

A handcrafted portfolio website for showcasing game design work, built with **Kirby CMS** and a custom **neobrutalist design system**. Every interaction is designed to feel like a game UI — bouncy easing, solid-shadow borders, tactile hover states, and spring-physics scrolling.


## Features

**Design & Interaction**
- Neobrutalist aesthetic with thick solid-shadow borders, yellow accent pops, and a dark color palette
- 3D card tilt with glare and holographic shimmer on project cards (desktop)
- Spring-physics smooth scrolling with configurable stiffness and damping
- Sticky project navigation that appears on scroll
- Bounce and pop easing curves on all interactive elements
- Fully responsive border/shadow hierarchy that scales down gracefully across breakpoints

**Content System**
- Devlog-style project pages with structured blocks: headings, text, images, video embeds, quotes, tables, side-by-side layouts, accordions
- Inline collapsible table of contents
- Project filtering by genre, platform, engine, and type
- Featured project carousel on the home page
- Per-page SEO fields with Open Graph and Twitter Card support
- Dynamic sitemap and robots.txt generation

**Performance & Security**
- Gzip compression, browser caching (1 year images/fonts, 1 month CSS/JS)
- Lazy-loaded images with responsive srcsets
- `.htaccess` hardening: blocks direct access to CMS internals, enforces HTTPS, sets security headers
- `prefers-reduced-motion` support throughout

## Tech Stack

| Layer    | Technology                             |
|----------|----------------------------------------|
| CMS      | [Kirby 4](https://getkirby.com)        |
| Backend  | PHP 8.1+                               |
| Styling  | SCSS (Sass)                            |
| JS       | Vanilla JavaScript (no framework)      |
| Icons    | Font Awesome 6 + custom engine icons   |
| Lightbox | GLightbox,                |            |
| Server   | Apache with mod_rewrite                |
