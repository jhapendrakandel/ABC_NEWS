# 06 — Template Hierarchy

## Core templates

| Template                | Role                                                        |
|-------------------------|-------------------------------------------------------------|
| `header.php`            | Doc head, logo, hamburger, nav menu, overlay, Nepali date.  |
| `footer.php`            | Footer ticker, social bar, fat footer grid, copyright bar.  |
| `index.php`             | Main News page with category sections and newsletter CTA.   |
| `single.php`            | Article with hero, meta, content, share bar, related, sidebar. |
| `single-live-blog.php`  | Alternate single template referencing CPT live_update.      |
| `page-live-update.php`  | Live updates timeline integrated with JS polling.           |
| `page-mainnews.php`     | Main News page variant with hero/featured/breaking toggle integration. |
| `updates.php`           | "Latest News" list template.                                |
| `breaking-banner.php`   | Partial called from page templates for breaking banners.    |

## Thin section page templates

These all share the same 6-9 line shape:
```php
<?php
/* Template Name: English */
get_header();
abcnepal_render_news_section('english');
get_footer();
```

List: `english.php`, `international.php`, `economics.php`, `Entertainment.php`, `sports.php`, `abc_video.php`, `opinion.php`, `page-*.php` variants.

## Duplicated province templates

`page-province.php` (160 lines) and `page-sahitaya.php` (160 lines) are effectively identical. Consider consolidating to a single template or routing both page slugs to one template.

## Fallback behavior

No `front-page.php`, `category.php`, `tag.php`, `author.php`, `search.php`, or `404.php` are present; WordPress falls back to `index.php` for all of them.
