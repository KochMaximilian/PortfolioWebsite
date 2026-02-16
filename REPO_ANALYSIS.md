# Repository Analysis & Improvement Recommendations

## Overall Understanding

This is a **game design portfolio website** for **Maximilian Koch**, built with **Kirby CMS v4** (PHP flat-file CMS). It showcases game design projects, an about page with skills, and includes a bookmarks system for curating design resources. The site follows a content-first, flat-file approach -- no database required.

### Architecture Summary

| Layer | Technology |
|---|---|
| CMS | Kirby 4 (PHP 8.1+) |
| Templating | Kirby PHP templates + snippets |
| Styling | Vanilla CSS with custom properties (design tokens) |
| JS Libraries | Flickity (carousel), PhotoSwipe (lightbox) |
| Fonts | Google Fonts (Barlow, Poppins) |
| Icons | Font Awesome 6 + custom SVG engine icons |
| Hosting | Apache (`.htaccess` configured) |

### Pages & Content Structure

| Page | Template | Description |
|---|---|---|
| Home | `home.php` | Featured projects carousel (Flickity), blocks support |
| Projects | `projects.php` | Filterable, paginated grid of all listed projects |
| Project (detail) | `project.php` | Individual project with embed/image, metadata, description, showcase gallery with PhotoSwipe lightbox |
| About | `about.php` | Author bio with responsive image, skills grid |
| Contact | `contact.php` | Currently empty |
| Bookmarks | (unlisted) | Personal resource bookmarks with categorized icons/colors (via `BookmarkPage` model) |

### Design Philosophy

The site has a distinct, intentional visual identity:

- **Bold, chunky borders** with solid box-shadows creating a "sticker/badge" aesthetic
- **Yellow highlight on hover** (color-yellow-dark) as the primary interaction color
- **Dark navbar/footer** framing the content
- **Animated tiled background** (pixelated pattern scrolling diagonally)
- **Scale-down hover effects** (0.95-0.97 scale) for interactive elements
- **Consistent cubic-bezier easing** for a playful, bouncy feel
- **Strong typographic hierarchy** with Barlow (headings) + Poppins (body)

This is a well-considered design with a strong personality. All recommendations below aim to **enhance and polish** this existing identity, not replace it.

---

## What's Done Well

1. **Excellent design token system** -- `config.css` has a thorough set of CSS custom properties for colors, spacing, typography, shadows, z-index, and breakpoints.

2. **Smart content architecture** -- The Kirby blueprints for projects are well-structured with appropriate field types (tags for genres/platforms, toggles for featured, link fields for embeds).

3. **Responsive image handling** -- Using `srcset` with multiple breakpoints and WebP format conversion shows good performance awareness.

4. **Conditional asset loading** -- CSS and JS are only loaded on pages that need them (Flickity on home, PhotoSwipe on project pages).

5. **Good separation of concerns** -- Templates are lean, snippets handle reusable components, controllers manage data logic, collections abstract queries.

6. **Accessible markup choices** -- Semantic HTML (`<figure>`, `<figcaption>`, `<details>/<summary>`, `<dl>`, `<nav>`), `aria-label` on pagination, `alt` text on images.

7. **BookmarkPage model** -- Clean use of PHP 8.0 `match` expressions for mapping categories to icons and colors.

8. **Security** -- `.htaccess` blocks direct access to content/site/kirby directories, has security headers, and the `.gitignore` properly excludes accounts/sessions/cache.

---

## Recommendations (Preserving Current Design)

### 1. Bug Fixes (High Priority)

#### 1a. CSS Syntax Error in `main.css` -- Stray forward slash in media queries

Lines 315-316 and 322-323 of `main.css` have broken CSS:

```css
@media (max-width: 600px) {
  html {
    font-size: 87.5%;/    /* <-- stray "/" will break parsing */
  }
}

@media (max-width: 1024px) {
  html {
    font-size: 93.75%;/   /* <-- same issue */
  }
}
```

These trailing `/` characters after the semicolons will cause the CSS parser to fail for those rules, potentially causing unpredictable behavior.

#### 1b. Missing CSS `var()` syntax in `main.css` line 279

```css
h1 {
  font-weight: var(font-black);  /* Missing -- prefix: should be var(--font-black) */
}
```

#### 1c. Missing closing parenthesis in `footer.php` inline JS (line 62)

```javascript
badge.style.fontSize = 'var(--font-size-xs';  // Missing closing ")"
```

Should be: `'var(--font-size-xs)'`

#### 1d. Typo in class name: `project-platfrom` (project.php line 57)

```html
<span class="project-platfrom">  <!-- Should be "project-platform" -->
```

#### 1e. `projects.php` template -- missing quotes on class attribute (line 11)

```html
<div class=page-zoom>  <!-- Should be class="page-zoom" -->
```

#### 1f. Heading snippet has malformed closing tag (heading.php)

```php
</d<?= $level ?>>  <!-- Generates </dh2> instead of </h2> -->
```

Should be:
```php
</<?= $level ?>>
```

#### 1g. Blueprint YAML indentation issue in `project.yml`

Lines 139-146 have incorrect indentation for `empty`, `width`, and `options` under the `engine` field. These should be indented to the same level as `label`, `type`, etc. Also lines 181-186 for the showcase section have similar issues.

#### 1h. Blueprint typos in `project.yml`

- "Embedet Link" should be "Embedded Link"
- "Video Titel" should be "Video Title"
- "Copy title form YouTube Vido" should be "Copy title from YouTube Video"
- "Projcet Awards" should be "Project Awards"
- "highilight. Possilbe" should be "highlight. Possible"
- "Schowcase" in `gallery-image.yml` and `showcase-image.yml` should be "Showcase"

#### 1i. `from.php` template references a `form` snippet that doesn't exist

`from.php` calls `snippet('form', ...)` but there's no `site/snippets/form.php`. There is a `from.php` snippet but it's not the right one. Also, the textarea in the contact form has `name="email"` instead of `name="message"`.

---

### 2. Duplicate CSS File (Medium Priority)

`assets/css/project.css` and `assets/css/templates/project.css` are **nearly identical** files (~95% same content). The differences are minor (a few spacing tweaks and one extra `@media (max-width: 1200px)` block that was replaced with `@media (max-width: 1440px)` in the non-templates version). Only `project.css` is loaded in `header.php`. The `templates/project.css` file appears to be a stale copy and should be removed to avoid confusion.

---

### 3. CSS Architecture Improvements (Medium Priority)

#### 3a. Reduce `!important` usage

There are many `!important` declarations, especially in responsive heading styles in `main.css` and in `projects.css`. These create specificity issues and make future changes harder. Most of these can be removed by restructuring the CSS cascade order -- load `main.css` **before** component CSS files, or use more specific selectors instead.

#### 3b. Extract repeated transition easing into a CSS variable

The easing function `cubic-bezier(0.25, 1.75, 0.5, 1.2)` appears ~40+ times across stylesheets. You already have `--transition-easing` defined in `config.css` with exactly this value -- just replace the hardcoded values with `var(--transition-easing)` throughout.

#### 3c. Similarly, use `--transition-fast` and `--transition-medium` variables

You define timing variables but never use them. Replace the many hardcoded `0.2s` and `0.3s` values.

#### 3d. Consolidate breakpoints

You use different breakpoint values in different files (576px, 600px, 768px, 992px, 1024px, 1200px, 1440px). Consider standardizing to a single set and documenting them. You already have breakpoint variables in `config.css` but they are declared as CSS custom properties (which can't be used in `@media` queries). A comment block at the top documenting the canonical breakpoints would help.

#### 3e. The `page-zoom` hack using `transform: scale(0.8)` at 1440px

In `projects.css`, `.page-zoom` applies `transform: scale(0.8)` which shrinks the entire page content. This is reset to `scale(1)` at 992px. This is a fragile approach -- it can cause blurry text, break fixed positioning, and create confusing zoom behavior. Consider adjusting the actual sizing/spacing values instead of using transform scale.

#### 3f. Reduce overly granular media queries for similar properties

Many breakpoints repeat near-identical changes (320px, 375px, 480px, 576px, 768px, 992px, 1200px, 1440px). Consider using `clamp()` for fluid typography and spacing:

```css
h1 {
  font-size: clamp(var(--font-size-xl), 4vw + 0.5rem, var(--font-size-6xl));
}
```

This would dramatically reduce the amount of responsive CSS needed.

---

### 4. HTML/Template Improvements (Medium Priority)

#### 4a. Add `loading="lazy"` to more images

The about page image and project overview images are missing the `loading="lazy"` attribute. Only the project detail page uses it.

#### 4b. Add `width` and `height` attributes to images

To prevent Cumulative Layout Shift (CLS), add explicit `width` and `height` attributes to `<img>` tags. This is especially important for the project grid cards and carousel images.

#### 4c. Social links in footer are missing `rel="noopener noreferrer"`

All external `target="_blank"` links should include `rel="noopener noreferrer"` for security:

```html
<a class="social-link" target="_blank" rel="noopener noreferrer" href="...">
```

#### 4d. Footer has duplicated social links for mobile

The footer currently renders the same social links **three times** (left desktop socials, center mobile socials left, center mobile socials right) and hides/shows them via CSS. This means screen readers and search crawlers see 9 social links instead of 3. Consider rendering them once and repositioning via CSS grid/flexbox.

#### 4e. Empty `<div>` in `home.php`

Lines 16-18 of `home.php` have an empty div:
```html
<div>
    
</div>
```
This should be removed.

#### 4f. `header.php` uses `$slots->head()` without guarding

Line 47 calls `$slots->head()` but not all templates pass slots to the header. This could cause errors. Wrap it:
```php
<?php if ($slots && $slots->head()): ?>
  <?= $slots->head() ?>
<?php endif ?>
```

#### 4g. Missing `alt` text for some images

- The favicon in the footer (`footer-logo`) has no `alt` attribute
- The carousel images could use more descriptive alt text

---

### 5. Performance Improvements (Medium Priority)

#### 5a. Google Fonts loading is render-blocking

The two Google Fonts links in `header.php` are loaded synchronously, blocking rendering. Use `font-display: swap` (already included via the `&display=swap` parameter, which is good) but also consider:

- Preloading the font files
- Subsetting the fonts (you load all 18 weights of both Barlow and Poppins -- that's a massive payload). You only use weights 300, 400, 500, 600, 800. Trim the import:

```html
<link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;500;600;800&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
```

#### 5b. Carousel thumbnail quality at 100%

In `projectslider.php`, the carousel image quality is set to `100`. For WebP, quality of 80-85 is visually indistinguishable and significantly smaller. Reduce it:

```php
'quality' => 80,
```

#### 5c. Remove console.log statements from production JS

`script.js` has multiple `console.log` and `console.error` calls for debugging the background animation. These should be removed for production.

#### 5d. Consider self-hosting Font Awesome

You're already serving FA from local files, which is great. But you could subset it to only include the icons you actually use, reducing the font file sizes substantially.

#### 5e. Background animation performance

The scrolling background uses two full-viewport `position: fixed` divs with a repeating pattern. Adding `will-change: background-position` or using `transform: translate3d()` instead of `background-position` animation would be more GPU-friendly.

---

### 6. Configuration & Deployment (Low Priority)

#### 6a. Debug mode is enabled in production config

```php
return [
    'debug' => true  // Should be false in production
];
```

This exposes detailed error messages to visitors. Set this to `false` for production, or better yet, use environment-based configuration:

```php
return [
    'debug' => env('KIRBY_DEBUG', false),
];
```

#### 6b. `composer.json` is still the default Kirby plainkit metadata

Update the `name`, `description`, and `authors` fields in `composer.json` to reflect this is your portfolio, not the generic Kirby Plainkit.

#### 6c. `README.md` is the default Kirby Plainkit readme

Replace with your own project description, setup instructions, and deployment notes.

---

### 7. Code Quality & Maintainability (Low Priority)

#### 7a. Repeated thumbnail config arrays

The same thumb configuration (width, height, crop, quality, format, driver) is repeated in multiple places: `projects.php` snippet, `projectslider.php`, `about.php`, `project.php`. Extract these into a Kirby config or a shared snippet/helper:

```php
// site/config/config.php
return [
    'thumbs' => [
        'presets' => [
            'card' => ['width' => 420, 'height' => 420, 'crop' => true, 'quality' => 60, 'format' => 'webp'],
            'slider' => ['width' => 600, 'height' => 300, 'crop' => true, 'quality' => 80, 'format' => 'webp'],
            'gallery' => ['width' => 250, 'height' => 250, 'crop' => true, 'quality' => 50, 'format' => 'webp'],
        ],
    ],
];
```

#### 7b. The `site.php` controller passes unused `$width` and `$height` variables

The site controller defines width/height variables that don't appear to be used in any template. Clean up or remove.

#### 7c. Empty files should be cleaned up

- `assets/js/navbar.js/navbar.js` is empty
- `site/templates/contact.php` is empty
- `content/contact/contact.txt` is minimal
- `site/templates/default.php` has no content

#### 7d. Typo in controller variable: `$unfilterd` should be `$unfiltered`

In `site/controllers/projects.php`, the variable `$unfilterd` is used consistently but is misspelled. Rename for clarity.

---

### 8. SEO & Meta Tags (Low Priority)

#### 8a. Add meta description tag

The `<head>` section has no `<meta name="description">` tag. Add one using the site's description field:

```php
<meta name="description" content="<?= $site->description()->html() ?>">
```

#### 8b. Add Open Graph / social sharing meta tags

For better sharing on social media:

```php
<meta property="og:title" content="<?= $page->title()->html() ?>">
<meta property="og:description" content="<?= $site->description()->html() ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= $page->url() ?>">
```

#### 8c. Add a canonical URL tag

```php
<link rel="canonical" href="<?= $page->url() ?>">
```

---

### 9. Accessibility Improvements (Low Priority)

#### 9a. Add `aria-label` to the navigation

```html
<nav class="navbar" aria-label="Main navigation">
```

#### 9b. Skip-to-content link

Add a visually hidden "Skip to main content" link at the top of the page:

```html
<a class="skip-link" href="#main-content">Skip to main content</a>
```

#### 9c. Button elements inside anchor tags (pagination)

The pagination snippet wraps `<button>` elements inside `<a>` tags, which is invalid HTML. Use one or the other:

```php
<a href="<?= $pagination->prevPageUrl() ?>" class="pagination-link" aria-label="Previous page">
    <i class="fa-solid fa-caret-left"></i>
</a>
```

#### 9d. Focus styles

There are no visible `:focus` styles defined. Keyboard users cannot see which element is focused. Add focus styles that match the existing hover aesthetic:

```css
:focus-visible {
  outline: 3px solid var(--color-yellow-dark);
  outline-offset: 2px;
}
```

---

### 10. Nice-to-Have Enhancements (Future)

- **Implement the contact page** -- currently empty. Consider using Kirby's Uniform plugin or a simple PHP mail handler.
- **Add a 404/error page template** -- there's an `error` content folder but no custom error template.
- **Add page transitions** -- with the existing animation style, subtle page transitions (via View Transitions API) would feel natural.
- **RSS feed** -- for projects updates, using Kirby's built-in feed support.
- **Sitemap.xml** -- for better SEO, Kirby has plugins for auto-generating sitemaps.
- **Dark mode toggle** -- the design system already has dark colors defined that could support this.

---

## Summary Priority Matrix

| Priority | Category | Items |
|---|---|---|
| **High** | Bug fixes | CSS syntax errors, missing parenthesis, heading snippet, blueprint YAML indentation, form snippet |
| **Medium** | CSS cleanup | Remove duplicate file, reduce `!important`, use existing variables, remove `page-zoom` hack |
| **Medium** | HTML quality | Fix duplicate footer links, add lazy loading, security attrs on external links |
| **Medium** | Performance | Trim font weights, reduce carousel quality, remove console.logs |
| **Low** | Config | Disable debug mode, update metadata, custom README |
| **Low** | Code quality | Extract thumb presets, fix typos, clean empty files |
| **Low** | SEO | Meta tags, Open Graph, canonical URLs |
| **Low** | A11y | Focus styles, skip link, fix button-in-anchor, nav labels |
