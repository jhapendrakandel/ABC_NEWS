# 18 — Known Issues

## Code duplication

- `function.php` and `functions.php` both define the same functions. Only one should own each function.
- `register_live_update_cpt()` is defined twice in `function.php` (lines 536 and 644).
- `page-province.php` and `page-sahitaya.php` are near-identical copies.

## Missing wiring

- `header-nav.js` is built to be the active drawer controller but is not enqueued.
- `js/live-updates.js` expects a `get_live_updates` AJAX action that does not exist.
- `footer.css` is empty; footer styles are inlined in `footer.php`.

## Template correctness

- `single-live-blog.php` mixes PHP and HTML in an order that produces output before `get_header()`.
- `page-arthabadijaya.php` uses a ternary that may not match the intended section for all users.

## Performance / placeholders

- `style.css` and `function.php` use `time()` as the asset version, disabling browser caching for `style.css`. Use `filemtime()` or a constant version in production.
- Placeholder images rely on `picsum.photos` and `placehold.co`, which may fail offline.

## Accessibility

- Some templates use inline styles heavily, making overrides harder.
- `breaking-banner.php` uses `tabindex="-1"` on the thumbnail link while the title is the accessible link — acceptable but could be tightened.

## CSS

- Legacy `.nav-toggle` and `.hamburger` classes are hidden but still shipped.
- Multiple `!important` overrides exist in `header-nav.js` and `header-nav.css`.

## i18n

- Strings are hardcoded in Nepali in many templates. The text domain `abcnepal-tv` is declared but not consistently used for these strings.
