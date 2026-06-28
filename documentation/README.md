# ABC_NEWS — Engineering Handbook

> Project: ABC Nepali News Portal
> Stack: WordPress 7.x, PHP, HTML, CSS, JavaScript, MySQL
> Audience: AI agents, new developers, future contributors
> Source: https://github.com/jhapendrakandel/ABC_NEWS
> Local copy: `/uki/ABC_NEWS`

This document is the permanent technical knowledge base for ABC_NEWS.
Before touching any other file in this project, start here.

---

## QUICK ORIENTATION (start here if you are new)

ABC_NEWS is a **custom WordPress theme** built for a professional Nepali news organization.
It is NOT a cloned theme. The design philosophy is informed by BBC News, The New York Times, ABC Nepal TV, and eKantipur — but original markup and editorial workflow decisions drive the implementation.

### Most important files

| File | Why it matters |
|------|----------------|
| `functions.php` | Registers the `live_update` CPT, AJAX load-more handling, short boot logic. |
| `function.php` | Core runtime: section config, news rendering, routing, template helpers, enqueue, CPT, post-hierarchy support. |
| `header.php` | Site header, logo, hamburger toggle, nav menu, overlay, Nepali date shortcode. |
| `footer.php` | Social bar, fat footer with 4-column layout, ticker bar, copyright row. |
| `single.php` | Full article template: hero, meta, content, share bar, related posts, sticky sidebar. |
| `index.php` | Main News page template — heavy use of `mn_*` prefixed styles and `mn_section()` helper. |
| `page-mainnews.php` | Toggle-aware Main News page (hero + + featured + breaking integration). |
| `page-live-update.php` | Live page that integrates with `live-update.js` polling and initial PHP render. |
| `style.css` | Master stylesheet with theme metadata and global CSS variables. |
| `header-nav.css` / `header-nav.js` | Separate navigation drawer stack (JS-driven, replaces old checkbox toggle). |
| `inc/news-toggles.php` | Breaking / Featured / Hero toggle metabox + admin columns. |
| `breaking-banner.php` | Hero-breaking banner partial that reads toggle-based "breaking posts". |
| `TEST-DontTouch/` | Frozen archive of earlier/larger theme snapshots. Do not edit. |

### Primary workflows

1. **Homepage / Main News** -> `index.php` ("Main News" template) breaks news into category-anchored sections.
2. **Section pages** -> very thin page templates delegate to `abcnepal_render_news_section()`,
   which in turn is fed by `abcnepal_section_config()`.
3. **Single post** -> `single.php` provides the article layout with sidebar and related stories.
4. **Live updates** -> Custom post type `live_update` + `update_topic` taxonomy + AJAX
   (`load_more_updates`) and polling (`live-updates.js`) against page template
   `page-live-update.php`.
5. **Breaking / featured / hero toggles** -> meta boxes added in `inc/news-toggles.php`
   drive `breaking-banner.php`, `page-mainnews.php`, and the homepage hero.

---

## HOW TO INSTALL

This repository is a **theme drop-in**.

1. Clone or copy this repo into your WordPress install:
   `wp-content/themes/abc-news/`
2. Activate the theme from Appearance > Themes.
3. Create a menu and assign it to the `main-menu` theme location.
4. Create pages and select templates:
   - Main News -> "Main News"
   - Live Update -> "Live Update Page"
5. Add categories whose slugs match the section config keys and WP category slugs listed in `index.php`.
6. Permalink save: Settings > Permalinks > Save (flush rewrite rules for the live_update CPT).
7. Images: replace `abc.png` at the theme root with the real logo.

### Category slug map (confirmed from `index.php`)

| Section             | WP category slug          |
|---------------------|---------------------------|
| main news           | `news`                    |
| politics            | `politics`                |
| business / artha    | `business`                 |
| opinion             | `opinion`                 |
| international       | `international_news`      |
| sports              | `sports`                  |
| english             | `english-special`         |
| province            | `province`                |
| province sub-slugs  | `provincial_koshi`, `provincial_madesh`, `provincial_gandaki`, `provincial_lumbini` |

---

## CODING STANDARDS IN THIS PROJECT

- Text domain: `abcnepal-tv`
- Escape every output: `esc_html()`, `esc_url()`, `esc_attr()`, `wp_kses_post()`, `absint()`.
- Never use `query_posts()`; always `WP_Query` + `wp_reset_postdata()`.
- Styles destined for the front end live in `style.css`; header-only styles in `header-nav.css`.
- JS intended for the footer must be enqueued with the footer flag true.
- Mobile nav is JS-driven now; `.nav-toggle` (checkbox) and `.hamburger` (CSS-only) are intentionally hidden.

---

## SEE ALSO

- `01-project-overview.md`
- `02-folder-structure.md`
- `03-theme-architecture.md`
- `04-wordpress-flow.md`
- `05-routing.md`
- `06-template-hierarchy.md`
- `07-functions-reference.md`
- `08-components.md`
- `09-css-architecture.md`
- `10-javascript-architecture.md`
- `11-database.md`
- `12-custom-features.md`
- `13-hooks-actions-filters.md`
- `14-dependencies.md`
- `15-plugin-analysis.md`
- `16-media-assets.md`
- `17-build-deployment.md`
- `18-known-issues.md`
- `19-roadmap.md`
- `20-ai-context.md`
