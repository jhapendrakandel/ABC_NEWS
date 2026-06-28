# 13 — Hooks, Actions, Filters

## Actions

| Hook                  | Callback                              | Purpose                                          |
|-----------------------|---------------------------------------|--------------------------------------------------|
| `after_setup_theme`   | `abcnepal_setup`                      | Theme supports + menu registration               |
| `wp_enqueue_scripts` | `abcnepal_styles`                     | Enqueue CSS/JS                                   |
| `init`                | `register_live_update_cpt` (x2)       | Register CPT + taxonomy                          |
| `init`                | `enable_post_hierarchy`               | Add page-attributes to post                      |
| `template_redirect`   | `abcnepal_live_update_route_status`   | Force 200 on live paths                          |
| `add_meta_boxes`      | `abcnt_register_toggle_metabox`       | Add News Toggles metabox                         |
| `save_post_post`      | `abcnt_save_toggles`                  | Save toggle meta with limits                     |
| `manage_posts_columns`| `abcnt_add_toggle_columns`            | Add admin columns                                |
| `manage_posts_custom_column` | `abcnt_toggle_column_content`  | Render admin column content                      |
| `wp_ajax_load_more_updates` / `wp_ajax_nopriv_load_more_updates` | `load_more_updates` | AJAX load more |

## Filters

| Hook                    | Callback                          | Purpose                                |
|-------------------------|-----------------------------------|----------------------------------------|
| `nav_menu_item_title`   | `abcnepal_translate_menu_title`   | Translate menu labels to Nepali        |
| `template_include`      | `abcnepal_live_update_template_route` | Force live page template on live paths |
| `manage_posts_sortable_columns` | `abcnt_sortable_toggle_columns` | Make toggle columns sortable   |

## Shortcodes

- `[ndc-today-date]` is used in `header.php` to render the Nepali date. This is provided by an external plugin (Nepali Date Converter), not by this theme.

## Notes

- The duplicate `register_live_update_cpt` definition means the second registration wins; the first is dead code.
- `load_more_updates` uses `check_ajax_referer('abc_live_update_nonce', 'nonce')` for security.
- No custom REST endpoints are registered; `show_in_rest` is enabled for the CPT and taxonomy.
