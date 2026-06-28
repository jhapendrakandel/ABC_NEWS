# 05 — Routing

WordPress handles mostRouting, but ABC_NEWS adds one custom route override.

## Standard routes

All standard WP routes apply:
- `/` -> homepage
- `/category/{slug}/` -> category archive
- `/liveupdate/` or `/live-update/` -> mapped to Live page template

## Custom live-update route

```php
function abcnepal_is_live_update_path() {
    // Returns true when request path is 'liveupdate' or 'live-update'
}

add_action('template_redirect', 'abcnepal_live_update_route_status', 0);
add_filter('template_include', 'abcnepal_live_update_template_route', 99);
```

Effect:
- Visiting `/liveupdate` or `/live-update` forces HTTP 200 and loads `page-live-update.php` even if no matching WP object exists.

## Implications

- Do NOT create a WordPress page called `liveupdate` expecting it to take route priority; the manual route intercepts first.
- If the live page slug needs to change, update `abcnepal_is_live_update_path()` and `page-live-update.php` consistently.

## Taxonomy routes

- `update_topic` taxonomy adds `/update_topic/{term}/`.
- `live_update` post type adds `/live_update/` archive and single posts at `/live_update/{slug}/`.
  These are not currently used by templates except through explicit queries.
