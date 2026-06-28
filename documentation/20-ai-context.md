# 20 — AI Context

This file is the onboarding document for any AI agent asked to continue development on ABC_NEWS.
Assume the agent starts with only this file and the codebase.

## Project purpose

ABC_NEWS is a custom WordPress theme for a professional Nepali news organization.
It is built to support editorial workflows (breaking news, featured stories, hero pinning, live blogs) and a responsive, accessible front end.

## Business requirements

- Breaking stories must be immediately visible.
- Editors must be able to pin a homepage hero and flag featured stories without code changes.
- Live updates must be publishable and viewable in near-real-time.
- The site must work well on mobile and desktop.
- The brand identity (red/navy/yellow) must be consistent.

## Current architecture

- Classic WordPress theme with template files, a small include directory, and front-end assets.
- One custom post type (`live_update`) and one custom taxonomy (`update_topic`).
- Editorial toggles stored as post meta (`_abcnt_breaking`, `_abcnt_featured`, `_abcnt_homepage_hero`).
- Section pages rendered by a shared helper `abcnepal_render_news_section()`.
- Header navigation uses a JS-driven drawer (`header-nav.js` + `header-nav.css`).

## Design philosophy

- Information architecture inspired by BBC News, NYT, ABC Nepal TV, eKantipur — not copied.
- Nepali-first UI with English section available.
- Strong visual hierarchy: breaking banner -> hero -> sidebar -> card grid.
- Accessibility considered (ARIA, focus management) but not yet complete.

## Major components

- `header.php` / `footer.php` — site chrome.
- `index.php` — Main News page with category sections.
- `single.php` — article page with sidebar and related posts.
- `page-live-update.php` — live blog timeline.
- `breaking-banner.php` — breaking news partial.
- `inc/news-toggles.php` — editorial toggle metabox + helpers.
- `function.php` / `functions.php` — runtime logic.

## Coding conventions

- Text domain: `abcnepal-tv`.
- Escape all output.
- Use `WP_Query` + `wp_reset_postdata()`.
- Prefer `get_template_directory_uri()` and `home_url()`.
- Prefix view-specific styles (`sp-*`, `mn-*`, `bnn-*`).

## Folder responsibilities

- Root: templates and theme-wide assets.
- `inc/`: feature modules loaded from `functions.php`.
- `js/`: front-end scripts.
- `TEST-DontTouch/`: frozen archive, never edit.

## How pages are rendered

1. WordPress resolves the request.
2. `functions.php` loads `inc/news-toggles.php` and registers hooks.
3. Template file runs, calls `get_header()` and `get_footer()`.
4. Section pages delegate rendering to `abcnepal_render_news_section()`.
5. Single posts use `single.php` with its own Loop and sidebar queries.
6. Live page uses `page-live-update.php` and exposes newest ID to JS.

## WordPress request lifecycle

See `04-wordpress-flow.md`. Key hooks:
- `after_setup_theme`
- `wp_enqueue_scripts`
- `init`
- `template_redirect`
- `template_include`
- `nav_menu_item_title`
- `save_post_post`
- `manage_posts_columns` / `manage_posts_custom_column`
- `wp_ajax_load_more_updates` / `wp_ajax_nopriv_load_more_updates`

## Important hooks

- `abcnepal_live_update_route_status` forces 200 on live paths.
- `abcnepal_live_update_template_route` forces `page-live-update.php` on live paths.
- `abcnepal_translate_menu_title` translates menu labels.
- `abcnt_save_toggles` enforces breaking-news limit of 5.

## Database relationships

- `live_update` CPT + `update_topic` taxonomy.
- Post meta keys: `_abcnt_breaking`, `_abcnt_featured`, `_abcnt_homepage_hero`.
- Category slugs drive section queries.

## Known technical debt

- Duplicate functions between `function.php` and `functions.php`.
- Duplicate `register_live_update_cpt` definition.
- `header-nav.js` not enqueued.
- `get_live_updates` AJAX handler missing.
- `footer.css` is empty.
- `single-live-blog.php` emits content before `get_header()`.
- `page-province.php` and `page-sahitaya.php` are duplicated.
- Placeholder images rely on third-party CDNs.

## Areas under development

- Live update polling is incomplete.
- Header navigation JS is not wired.
- Newsletter form has no backend.

## Current progress

- Templates render correctly for the homepage, sections, single posts, and live page.
- Breaking/featured/hero toggles work end-to-end.
- AJAX load-more for live updates works.

## Pending features

- Wire `header-nav.js`.
- Implement `get_live_updates` AJAX handler.
- Replace placeholder image services.
- Add missing template fallbacks (`front-page.php`, `category.php`, `search.php`, `404.php`).

## Recommended workflow

1. Read `README.md` and this file.
2. Pick up one item from `19-roadmap.md`.
3. Make the smallest possible change.
4. Verify with `php -l` for PHP files and by loading the relevant page.
5. Update this documentation if architecture changes.

## Common pitfalls

- Do not edit `TEST-DontTouch/`.
- Do not use `query_posts()`.
- Do not enqueue `header-nav.js` without testing the drawer.
- Do not remove `wp_reset_postdata()` after custom queries.
- Do not hardcode `http://` URLs.
- Do not assume `get_live_updates` exists.

## Important notes for future AI agents

- Treat `function.php` as the source of truth for runtime helpers; `functions.php` is a thin bootstrap.
- When adding new section pages, follow the existing thin-template pattern.
- When adding new templates, escape everything and use the existing CSS variables.
- When touching live-update functionality, verify both the PHP query and the JS expectations.
