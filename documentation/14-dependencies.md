# 14 — Dependencies

## PHP / WordPress

- WordPress 7.x (confirmed)
- PHP 8.x-compatible WP APIs
- No Composer packages

## JavaScript libraries

- WordPress-bundled jQuery is used by `js/live-update.js`.

## External CDNs / services currently in use

| URL                                   | Usage                                  |
|----                                   | -------------------------------------- |
| `https://picsum.photos/...`           | Placeholder images when post has no thumbnail |
| `https://placehold.co/...`            | Placeholder images used in index/main-news |

These are the only external image sources in the templates. Anything else is local or inline SVG.

## Known risks

- `picsum.photos` and `placehold.co` are third-party; in offline or locked-down environments these placeholders may fail to load. Replace with local fallbacks for production.
- Social share buttons post to Facebook/Twitter/WhatsApp/Viber endpoints. Those are external by design.
- No external icon CDNs are used; social icons are inline SVGs.

## Integrated plugins

- `[ndc-today-date]` shortcode requires the **Nepali Date Converter** plugin.
- `header.php` uses `do_shortcode('[ndc-today-date]')`; if the plugin is missing the header still renders but shows nothing.
