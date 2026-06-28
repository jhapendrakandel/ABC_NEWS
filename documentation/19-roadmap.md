# 19 — Roadmap

Suggested order of improvements. These are not commitments but reflect technical-debt and feature gaps identified in this snapshot.

## Short term

- De-duplicate `function.php` / `functions.php` so each function lives in exactly one file.
- Remove the duplicate `register_live_update_cpt` definition.
- Enqueue `header-nav.js` or remove it if not intended to replace the older drawer.
- Implement or delete the missing `get_live_updates` AJAX handler.
- Replace `time()` version strings with a static version or `filemtime()`.
- Add proper `@font-face` or enqueue for `Noto Sans Devanaguri` and `Hind Siliguri`.

## Medium term

- Replace third-party placeholder image services with local fallbacks or a proper "no thumbnail" graphic.
- Consolidate `page-province.php` and `page-sahitaya.php`.
- Localize hardcoded Nepali strings via `__()` / `_e()` for i18n consistency.
- Add the missing template files (`front-page.php`, `category.php`, `search.php`, `404.php`) for cleaner fallback behavior.

## Long term

- Introduce a small build pipeline (RTL CSS, asset minification, cache-busting) without over-engineering.
- Move inline styles from templates into `style.css` / `header-nav.css` where practical.
- Consider CPT/taxonomy REST exposure for future headless or mobile use.
- Add automated tests covering template loading and AJAX endpoints.

## Out of scope (for now)

- Headless frontend.
- Migration off WordPress.
- Rebuilding as a full-block theme.
