# 17 — Build & Deployment

## Build

There is no build step. This is a plain PHP/CSS/JS WordPress theme.

## Local development

1. Set up a local WordPress install (LocalWP, MAMP, Valet, Docker, etc.).
2. Place this theme under `wp-content/themes/abc-news/`.
3. Activate the theme.
4. Create a menu at Appearance > Menus and assign it to `main-menu`.
5. Create pages and assign templates (Main News, Live Update Page).
6. Add categories matching the slugs in `index.php`.
7. Save Permalinks once to flush rewrite rules.

## Deployment

1. Deploy the theme directory to `wp-content/themes/abc-news/` on the server.
2. Activate the theme.
3. Re-save Permalinks.
4. Replace `abc.png` with the production logo.
5. Replace placeholder image URLs (`picsum.photos`, `placehold.co`) with real content or local fallbacks.
6. Ensure the Nepali Date Converter plugin is active if the `[ndc-today-date]` shortcode is required.

## Environment assumptions

- WordPress 7.x
- PHP 8.0+
- MySQL 5.7+ / MariaDB 10.3+
- HTTPS recommended (share buttons and mixed-content rules)
