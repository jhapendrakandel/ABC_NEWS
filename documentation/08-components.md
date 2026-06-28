# 08 — Components

## Header

- Logo: `abc.png`, overridable via Customizer `custom-logo`.
- Hamburger button with `aria-controls`, `aria-expanded`, `aria-label`.
- Drawer `<nav id="abc-main-nav">` rendered by `wp_nav_menu(['theme_location' => 'main-menu', 'depth' => 1])`.
- Hardcoded fallback menu with category links.
- Backdrop overlay `<div id="abc-nav-overlay">`.
- Nepali date shortcode `[ndc-today-date]`.

## Footer

- Ticker bar with LIVE label and tagline.
- Social bar with brand block and inline SVG icons for Facebook, Twitter/X, YouTube, Instagram, WhatsApp, LIVE TV.
- 4-column grid:
  1. About block + contact info.
  2. Advertisement + quick nav.
  3. News categories (excluding uncategorized).
  4. Team list.
- Copyright bar.

## Breaking Banner (`breaking-banner.php`)

- Supports up to 5 concurrent breaking banners.
- Optional thumbnail, title, excerpt, category badge, date, CTA button.
- Pulse-dot animation.

## News Section (`abcnepal_render_news_section`)

- Breaking banner headline + marquee.
- Hero headline (first post title or fallback).
- Hero image (post thumbnail or picsum placeholder).
- Sidebar list (next 5 posts, falling back to config `latest` headlines).
- Card grid (next 8 posts, falling back to config `cards` headlines).
- Ad slot placeholder image.

## Single Post

- Ticker bar with latest post title from same category.
- Category tag, title, meta row (date/time/author).
- Featured image with optional caption.
- Article body via `the_content()`.
- Share links row (FB, Twitter/X, WhatsApp, Viber).
- Related posts grid (same category, 3 most recent).
- Sticky sidebar: top 10 same-category posts with numbered items + 300x250 ad slot placeholder.

## Live Update Page

- Main title + status dot.
- Timeline of live_update entries with author avatar/name, timestamp, content.
- Newest post ID exposed via `<meta id="live-last-id">`.
- Polling JS appends new entries and refreshes timestamps.

## Live Update Card

- Title, time + author meta, content.

## Social Share Buttons

- SVG icons inline; hosted on the same origin (no third-party icon CDNs).

## Newsletter Block

- Email input + subscribe button on Main News page (no backend wiring in this snapshot).

## Province Sub-Sections

- 4-column grid with Koshi, Madhesh, Gandaki, Lumbini placeholders.
