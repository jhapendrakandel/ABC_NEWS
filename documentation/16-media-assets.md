# 16 — Media & Assets

## Images / logos

| Path       | Purpose              |
|------------|----------------------|
| `abc.png`  | Theme logo used in header and footer. |

## SVG icons

Inline SVG icons exist in:
- `share buttons` in `single.php`
- `footer social bar` in `footer.php`
- `breaking clock icon` in `breaking-banner.php`
- `single post meta icons` in `single.php`

## CSS

| File             | Purpose                                            |
|------------------|----------------------------------------------------|
| `style.css`      | Global styles and theme headers                    |
| `header-nav.css` | Modern drawer navigation stack                     |
| `footer.css`     | Present but empty                                  |

## JS

| File                   | Purpose                                                    |
|------------------------|------------------------------------------------------------|
| `header-nav.js`        | Mobile drawer controller                                   |
| `js/live-update.js`    | AJAX load-more for live updates                            |
| `js/live-updates.js`   | Polling for live updates (inactive)                        |

## Fonts

- `Noto Sans Devanagari`
- `Hind Siliguri`

These are referenced but not enqueued locally; they must be available via theme or plugin or will fall back to system fonts. Add a local `@font-face` or enqueue from Google Fonts if needed.

## Ad slots

- `index.php` footer section uses `picsum.photos/1200x150`.
- `single.php` sidebar slot uses placeholder text "300 × 250 विज्ञापन".
- No ad plugin is integrated.
