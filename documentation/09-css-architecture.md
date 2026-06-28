# 09 — CSS Architecture

## Files

| File           | Purpose                                                        |
|----------------|----------------------------------------------------------------|
| `style.css`    | Master stylesheet; theme meta + global variables + components. |
| `header-nav.css` | Header/nav drawer stack (modern replacement for older `.nav-toggle`). |
| `footer.css`   | Empty. Footer styles are inlined in `footer.php`.              |

## Design tokens

```css
:root {
  --color-primary: #0a1633;
  --color-secondary: #b80000;
  --color-secondary-dark: #8b0000;
  --color-accent: #ffcc00;
  --color-text: #111827;
  --color-muted: #4b5563;
  --color-border: #e5e7eb;
  --color-surface: #ffffff;
  --color-page: #f4f4f4;
  --shadow-soft: 0 8px 24px rgba(10, 22, 51, .08);
  --radius: 8px;
  --container: 1400px;
}
```

`header-nav.css` defines its own prefixed variables (`--abc-red`, `--abc-navy`, `--header-h`, `--mobile-menu-w`, `--ease-smooth`, `--ease-bounce`).

## Naming conventions

- `style.css` uses generic class names prefixed by context (`breaking-news`, `main-headline`, `news-grid`, `category-grid`, `hero`, `site-footer`, `homepage-box`, `update-entry`, etc.).
- `single.php` and `index.php` use view-specific prefixes:
  - `sp-*` for single post
  - `mn-*` for main news
  - `bnn-*` for breaking news banner
- `header-nav.css` uses native classes but overrides existing `.site-header`, `.main-navigation`, `.main-menu`.

## Layout techniques

- CSS Grid is the primary layout mechanism (`grid-template-columns` with `repeat()` fallbacks).
- Flexbox for horizontal arrangements.
- `clamp()` for fluid typography.
- Mobile drawer uses `transform: translateX(110%)` -> `translateX(0)` transition.

## Responsive breakpoints

| Breakpoint    | Effect                                                                |
|---------------|-----------------------------------------------------------------------|
| >= 1400px     | Wider menu item padding/font.                                         |
| <= 1200px     | Container narrows, category grid drops to 3 cols, menu tighter.       |
| <= 1024px     | News grids collapse to 1 col, hero collapses.                         |
| <= 900px      | Header switches to hamburger + drawer (header-nav.css).               |
| <= 768px      | Header grid changes, sidebar becomes stacked, footer centers.         |
| <= 600px      | News list row collapses to single column.                             |
| <= 580px      | Main News grid collapses further, featured image shrinks.             |
| <= 480px      | Font size shrinks, header padding tightens.                           |
| <= 380px      | Drawer uses full-width.                                               |

## Animations

- `fadeUp` used to fade-in cards and hero sections.
- Keyframe `.nav-toggle:checked + .hamburger span` line rotation for the old drawer.
- `bnn-pulse` for breaking-news live dot.
- `ticker` for footer marquee movement.

## Known CSS issues

- `footer.css` is empty while footer styles are embedded in `footer.php`.
- Some legacy classes (`.nav-toggle`, `.hamburger`) still exist but are hidden;
  cleaning them is safe but not urgent.
- Multiple `!important` overrides (`.nav-toggle, .hamburger { display: none !important }`).
- Inline styles appear frequently in templates and some components.
