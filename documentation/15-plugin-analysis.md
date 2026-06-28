# 15 — Plugin Analysis

This theme is intentionally self-contained and does not rely on page builders or major framework plugins.

## Required / expected plugins

| Plugin                | Required? | Purpose                                  |
|-----------------------|-----------|------------------------------------------|
| Nepali Date Converter | Soft      | Provides `[ndc-today-date]` shortcode.   |

## Compatible plugin categories

- SEO plugins (Yoast, Rank Math) — theme outputs proper title tags and semantic markup.
- Caching plugins — no JS-based critical rendering that would break with standard page cache.
- Social sharing plugins — theme already has built-in share buttons; avoid duplicating.
- Image optimization plugins — theme uses `the_post_thumbnail()` with standard image sizes.

## Conflicts to watch

- Any plugin that rewrites `/liveupdate` or `/live-update` routes.
- Plugins that deregister jQuery will break `js/live-update.js`.
- Plugins that alter `nav_menu_item_title` may stack with `abcnepal_translate_menu_title`.
