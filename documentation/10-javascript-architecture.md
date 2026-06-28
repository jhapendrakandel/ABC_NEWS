# 10 — JavaScript Architecture

## Files

| File                 | Enqueued? | Purpose                                               |
|----------------------|-----------|-------------------------------------------------------|
| `header-nav.js`      | No        | Modern mobile drawer: open/close, overlay, focus trap, Escape, resize, scroll shadow. |
| `js/live-update.js`  | Yes       | AJAX "load more" button for live_update entries.      |
| `js/live-updates.js` | No        | Polling loop for new live updates + timestamp refresh (expects missing backend action). |

> Despite documentation inside the files, only `js/live-update.js` is wired into `wp_enqueue_scripts` (conditionally on the Live Update page or path).
> `header-nav.js` and `js/live-updates.js` are NOT enqueued in this snapshot.

## header-nav.js

Vanilla IIFE. Features:
- DOMContentLoaded bootstrap.
- State `isOpen`.
- `openMenu`, `closeMenu`, `toggleMenu`.
- Overlay click closes; Escape closes.
- Focus trap within `.main-navigation` while open on mobile.
- Auto-close on resize to desktop.
- Auto-close after link clicks on mobile.
- Adds `.scrolled` class to header based on `scrollY > 4`.

## js/live-update.js

jQuery-wrapped. Features:
- Binds `#load-more-btn` click.
- Reads current `data-page` attribute, increments after success.
- POSTs to `abcLiveUpdate.ajaxUrl` with action `load_more_updates`, nonce, page, topic.
- Appends response to `#live-feed`.
- Topic is sourced from button `data-target`, `#live-feed` `data-topic`, or URL `topic` query var.

## js/live-updates.js

Vanilla IIFE. Features:
- Polls `admin-ajax.php?action=get_live_updates&last_id=<id>` every 15 seconds.
- Refresh timestamps every 60 seconds.
- Toast notification for new updates.
- Auto-collapse content > 40 words with "Show more/less" toggle.
- Sorts new entries by `data-id` descending and prepends to `#live-feed`.

## Missing wiring

- `header-nav.js` is built to be the active drawer controller, but `functions.php` does not enqueue it.
- `js/live-updates.js` is built to poll, but the backend action `get_live_updates` is missing.
- Communicating whichever new agent works on this: fix by enqueueing the scripts and providing the missing AJAX handler, or delete the dead code.

## Naming

- JS uses vanilla DOM APIs; only `live-update.js` depends on jQuery.
- Global `abcLiveUpdate` object localized by `wp_localize_script`.
