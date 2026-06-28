# 02 — Folder Structure

Snapshot of the current repo working tree:

```
ABC_NEWS/
├── .git/
├── abc.png                       # Theme logo
├── breaking-banner.php           # Breaking news banner partial
├── economics.php                 # Thin page template -> abcnepal_render_news_section('economics')
├── english.php                   # Thin page template -> abcnepal_render_news_section('english')
├── Entertainment.php             # Thin page template -> abcnepal_render_news_section('entertainment')
├── footer.css                    # Currently empty (footer styles live in footer.php <style> block)
├── footer.php                    # Fat footer (ticker, social bar, grid of columns, copyright)
├── function.php                  # Core runtime functions (section config, renderers, CPT, AJAX, enqueue)
├── functions.php                 # Bootstrap require_once of inc/news-toggles.php + CPT and helpers
├── header-nav.css                # Modern mobile-first navigation stylesheet
├── header-nav.js                 # Modern mobile drawer JS controller
├── header.php                    # Site header with logo + modern hamburger + overlay
├── inc/
│   └── news-toggles.php          # Breaking/Featured/Hero metabox + helper functions
├── index.php                     # Main News page template ("Template Name: Main News")
├── international.php             # Thin page template -> 'international'
├── js/
│   ├── live-update.js            # AJAX "load more" for live_update CPT
│   └── live-updates.js           # JS polling for live_update entries + timestamps
├── opinion.php                   # Thin page template -> 'opinion'
├── page-*.php                    # Thin page templates (category-specific layouts, province, etc.)
├── single-live-blog.php          # Alternate single template referencing the CPT
├── single.php                    # Default single post template with article + sidebar
├── sports.php                    # Thin page template -> 'sports'
├── style.css                     # Master stylesheet (contains theme header metadata)
├── TEST-DontTouch/               # Frozen archive of earlier/larger theme snapshot
└── updates.php                   # "Latest News" page template
```

## Responsibilities

- Root PHP files implement the public theme.
- `inc/` is the only include directory; it holds feature modules loaded from `functions.php`.
- `js/` holds front-end scripts; only `live-update.js` is currently enqueued.
- `TEST-DontTouch/` is explicitly excluded from any edits.

## Notable observations

- The small page templates (e.g., `english.php`, `opinion.php`) are all ~9 lines and only
  call `abcnepal_render_news_section()`.
- `page-province.php` and `page-sahitaya.php` are duplicated implementations of the same
  province query loop.
- `page-arthabadijaya.php` chooses between `economics` and `artha` section keys at runtime.
- `TEST-DontTouch/` includes an expanded `functions.php`, bigger `page-mainnews.php`, and a
  significantly larger `style.css`, implying an earlier architecture that was superceded.
