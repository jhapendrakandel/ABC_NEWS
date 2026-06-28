# 12 — Custom Features

## 1. Breaking News Toggle

- Enabled via `inc/news-toggles.php`.
- Up to 5 posts can be flagged simultaneously.
- `abcnt_save_toggles` enforces the limit.
- `breaking-banner.php` renders the active posts in descending order.
- Helper functions expose the data for templates: `abcnt_get_breaking_posts()`, `abcnt_get_breaking_post()`.

## 2. Featured Posts Toggle

- Unlimited posts can be flagged.
- Used by `page-mainnews.php` to populate a sub-hero section before the grid.

## 3. Homepage Hero Toggle

- Only one post active at a time.
- When set, all others are cleared via `abcnt_clear_flag_from_others()`.
- Rendered by `page-mainnews.php` as the prominent hero area.

## 4. Live Updates

- Custom post type `live_update`.
- Custom taxonomy `update_topic`.
- Page template `page-live-update.php` shows timeline with newest ID exposed to JS.
- AJAX `load_more_updates` is implemented for back-pagination.
- Polling JS expects `get_live_updates` action which does not exist yet.

## 5. Section Renderer

- `abcnepal_render_news_section($section)` is the workhorse for category / section pages.
- Driven by `abcnepal_section_config($section)`.


## 6. Menu Translation

- `abcnepal_translate_menu_title()` maps multiple English labels to Nepali output case-insensitively.
- Alternative spellings map uniquely (rajneeti/rajniti, kutni/kutniti).

## 7. Nav Drawer

- Replaces the older checkbox + CSS transition approach.
- Uses `header-nav.js` and `header-nav.css`.
- Accessible: ARIA attributes, focus trap, Escape close, scroll lock.

## 8. Live-Blog Single Template

- `single-live-blog.php` is an alternate single template.
- Path in this snapshot outputs content before `get_header()` due to PHP mixing; should be cleaned up if used.

## 9. Latest News Page

- `updates.php` lists the 15 most recent posts in a grid layout.

## 10. Post Hierarchy Support

- `enable_post_hierarchy()` adds `page-attributes` to core `post` so parent-page dropdowns are available.
