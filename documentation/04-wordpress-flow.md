# 04 — WordPress Flow

This theme follows standard WordPress lifecycle with a few customizations.

## Request lifecycle

1. WordPress loads and resolves the request.
2. `after_setup_theme` fires `abcnepal_setup()`:
   - `add_theme_support('title-tag')`
   - `add_theme_support('post-thumbnails')`
   - `register_nav_menus(['main-menu' => 'Main Menu'])`
3. `wp_enqueue_scripts` fires `abcnepal_styles()`:
   - Enqueue `style.css` with `time()` cache-buster.
   - Conditionally enqueue `js/live-update.js` and localize `abcLiveUpdate` for the live page.
4. `nav_menu_item_title` filter translates menu titles to Nepali via `abcnepal_translate_menu_title()`.
5. `init` fires:
   - `register_live_update_cpt()` (twice, duplicate definition).
   - `enable_post_hierarchy()` adds `page-attributes` support to `post`.
6. `template_redirect` fires `abcnepal_live_update_route_status()` to force 200 on live paths.
7. `template_include` filter `abcnepal_live_update_template_route()` routes `/liveupdate` and `/live-update` to `page-live-update.php`.
8. Template file runs and emits page HTML.
9. `wp_footer()` triggers footer scripts.

## Template resolution map

| Request                  | Template                              |
|--------------------------|---------------------------------------|
| Homepage                 | `front-page.php` if present, else `index.php` |
| Single post              | `single.php`                          |
| Single live_update       | `single-live-blog.php` (if matched)   |
| Category archive         | `category.php` -> `archive.php` -> `index.php` |
| Tag archive              | `tag.php` -> `archive.php`            |
| Page by slug             | `page-{slug}.php` -> `page.php`       |
| Live path                | `page-live-update.php`                |
| Search                   | `search.php`                          |
| 404                      | `404.php`                             |

## AJAX endpoints

| Action                 | Handler                  | Location      |
|------------------------|--------------------------|---------------|
| `load_more_updates`    | `load_more_updates()`    | `function.php` |
| `get_live_updates`     | NOT IMPLEMENTED          | missing        |

## Rewrite / routing

- The `live_update` post type has `has_archive => true` and a taxonomy `update_topic` with slug `update_topic`.
- Custom URL paths `liveupdate` and `live-update` are intercepted and mapped to the live page template.

## Hooks used

See `13-hooks-actions-filters.md` for the full list.
