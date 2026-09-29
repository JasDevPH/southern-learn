# Southern Learn – sample block theme
Custom block theme for a fictional Australian online-education brand.

## Decisions
- No page builder, no jQuery, no web-font requests (system fonts) → fast LCP.
- All design tokens live in `theme.json` (colours, fluid type, spacing) so editors can't go off-brand.
- Patterns (hero, course cards, FAQ) are reusable and editable in Gutenberg.
- FAQ uses native `<details>` (no JS) → accessible and easy for answer engines to parse.
- One H1 per page, logical H2/H3 order, skip link, visible focus states.
- JSON-LD `EducationalOrganization` on the home page.

## Run locally
Install WordPress Playground or LocalWP, copy this folder to `wp-content/themes/`, activate, then set Settings → Reading → homepage to a static page.

## Deploy (WP Engine)
Git push (WP Engine Git Push) or SFTP the theme folder to `wp-content/themes/`.

## To do / next
- Custom post type `course` + block bindings for price/duration
- Per-page FAQPage schema from the details blocks
- Lighthouse report screenshots in /docs

## v1.1 redesign
- Dark gradient hero, glass sticky header, card grid, CTA band.
- `assets/main.js` (progressive enhancement, no libraries): header shrink on scroll, scroll-reveal stagger, animated stat counters, pointer-following hero glow, smooth FAQ open/close.
- Content stays visible without JS; all motion is disabled under `prefers-reduced-motion`.
- `style.css` is enqueued in `functions.php` (block themes do not load it automatically) with a filemtime version for cache busting.

## v1.2 – Courses
- Course data lives in the companion plugin `southern-courses` (custom post type, meta fields, sample content) so it survives theme changes.
- Theme templates: `archive-course.html` (all courses) and `single-course.html` (course detail with sticky sidebar).
- Course details are shown with the Block Bindings API (`core/post-meta`), so no custom PHP templates are needed.
- The home page "Popular courses" is a Query Loop over the same post type.
