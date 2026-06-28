# 07 — Functions Reference

## `function.php` (core runtime)

| Function | Signature | Purpose |
|----------|-----------|---------|
| `abcnepal_setup` | `()` | Theme supports + menu registration |
| `abcnepal_is_live_update_path` | `()` | Returns bool for `/liveupdate` and `/live-update` paths |
| `abcnepal_styles` | `()` | Enqueue `style.css` (+ live script where appropriate) |
| `abcnepal_translate_menu_title` | `($title)` | Convert English menu labels to Nepali |
| `abcnepal_live_update_route_status` | `()` | Force HTTP 200 on live paths |
| `abcnepal_live_update_template_route` | `($template)` | Force `page-live-update.php` on live paths |
| `abcnepal_section_config` | `($section)` | Return static config array for a named section |
| `abcnepal_render_sample_image` | `($seed, $size)` | picsum.photos placeholder image |
| `abcnepal_render_news_section` | `($section)` | Render breaking banner + hero + sidebar + card grid for a section |
| `register_live_update_cpt` | `()` | Register `live_update` CPT and `update_topic` taxonomy (defined twice) |
| `abcnepal_get_live_update_topic_slug` | `()` | Read `topic` query var safely |
| `abcnepal_live_update_query_args` | `($paged, $topic)` | Build query args for live updates |
| `abcnepal_render_live_update_card` | `()` | Render one live update article card |
| `load_more_updates` | `()` | AJAX handler for `load_more_updates` action |
| `enable_post_hierarchy` | `()` | Add `page-attributes` support to `post` |

## `functions.php`

| Function | Purpose |
|----------|---------|
| `abcnepal_setup` | Mirror of the theme setup (duplicate in bootstrap file) |
| `abcnepal_is_live_update_path` | Duplicate helper |
| `abcnepal_styles` | Duplicate enqueue logic |
| `abcnepal_translate_menu_title` | Duplicate menu title translation |
| `abcnepal_live_update_route_status` | Duplicate route status |
| `abcnepal_live_update_template_route` | Duplicate template routing |
| `abcnepal_section_config` | Duplicate section config |
| `abcnepal_render_sample_image` | Duplicate image placeholder |
| `abcnepal_render_news_section` | Duplicate renderer |

## `inc/news-toggles.php`

| Function | Purpose |
|----------|---------|
| `abcnt_register_toggle_metabox` | Register "News Toggles" side metabox |
| `abcnt_toggle_metabox_html` | Output Breaking/Featured/Hero checkboxes |
| `abcnt_save_toggles` | Save metabox, enforce breaking limit of 5 |
| `abcnt_clear_flag_from_others` | Remove a flag from all other posts |
| `abcnt_count_flagged` | Count posts with a given meta flag |
| `abcnt_add_toggle_columns` | Add admin column headers |
| `abcnt_toggle_column_content` | Render column content |
| `abcnt_sortable_toggle_columns` | Make columns sortable |
| `abcnt_get_breaking_posts` | Return up to N active breaking posts |
| `abcnt_get_breaking_post` | Return one active breaking post |
| `abcnt_get_hero_post` | Return the pinned hero post |
| `abcnt_get_featured_posts` | Return featured posts |

## Top-level names

- `mn_section($cfg)` defined inside `index.php` — used to render each sub-section section on the main news page.
