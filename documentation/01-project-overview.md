# 01 — Project Overview

## Purpose

ABC_NEWS is a custom WordPress news portal theme for a professional Nepali media organization `ABC_MEDIA Group`, based in Lazimpat/Kathmandu.
It is designed to deliver fast editorial workflows, prominent breaking-news handling, live-blogging of developing stories, and Nepali-first UX informed by international editorial design patterns.

## Goals

- Editorial clarity: breaking stories and pinned hero stories must be obvious.
- Newsroom-friendly: simple admin toggles for "breaking", "featured", "homepage hero" with clear limits.
- Performant: CSS/JS is loaded conditionally; graphics rely on standard WP post thumbnails.
- Multilingual content, single-language UX: Nepali UI, English section rendered when relevant.

## Technology choices

| Layer    | Choice                                            |
|----------|---------------------------------------------------|
| CMS      | WordPress 7.x                                     |
| Backend  | PHP (template tags, WP_Query, hooks, AJAX)        |
| DB       | MySQL / `$wpdb` through WP APIs                   |
| Frontend | HTML, CSS Grid, vanilla JS + jQuery for admin-era scripts |
| Fonts    | Noto Sans Devanagari, Hind Siliguri               |
| Brand    | SVG social icons rendered inline; png logo at root |

## Non-goals

- Headless / decoupled delivery.
- Mobile app.
- Hard-copy pixel recreation of BBC/NYT. Inspiration only.

## Current status

The project has three git commits in this snapshot (66d8b38, ab0176d, 7697e3f) and is functionally active: templates work, live updates are supported, and the theme is enqueuing assets.
The `TEST-DontTouch/` folder is **frozen** and contains larger older variants (`style.css` 1972 lines, `functions.php` 737 lines, `page-mainnews.php` 947 lines) that should never be edited.
