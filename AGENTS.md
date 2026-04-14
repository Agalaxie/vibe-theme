# AGENTS.md — How to work in vibe-theme

> **You are reading this because you are an AI coding assistant (Claude, Cursor, GPT, etc.) working inside the vibe-theme WordPress theme.** This file tells you everything you need to know to make changes safely.

## What is vibe-theme?

vibe-theme is a WordPress **block theme** using the **Full Site Editing (FSE)** architecture. That means:

- Layouts are defined as HTML files containing WordPress **block markup** (`<!-- wp:group -->`, etc.) — NOT PHP templates.
- Global design (colors, fonts, sizes, spacing) is defined declaratively in `theme.json` — NOT in CSS files.
- `functions.php` stays tiny. Business logic goes in plugins, not the theme.

## Golden rules

**DO**
- Edit `theme.json` for anything global: colors, fonts, font sizes, spacing, button styles, heading styles.
- Edit `.html` files in `templates/` and `parts/` to change layouts.
- Read the `@vibe-*` comment header at the top of each file before editing — it tells you what's safe and what's not.
- Preserve WordPress block comment markers exactly (`<!-- wp:xxx --> ... <!-- /wp:xxx -->`). The block editor parses them literally.
- Keep `functions.php` under 50 lines.

**DON'T**
- Don't add inline CSS or `<style>` tags in HTML templates — use `theme.json`.
- Don't touch `index.php` — it's a required WordPress fallback and must stay empty.
- Don't create new top-level directories (`assets/`, `inc/`, `lib/`, etc.) without asking the user first.
- Don't add business logic to `functions.php` — suggest a plugin instead.
- Don't rename files — WordPress expects these exact names.
- Don't remove `wp:site-title`, `wp:post-content`, `wp:post-title`, or other core blocks just because they look like placeholders. WordPress needs them to inject real content.

## "I want to change X" → "Edit Y"

| What the user wants                    | What to edit                                      |
|----------------------------------------|---------------------------------------------------|
| Primary color / any brand color        | `theme.json` → `settings.color.palette`           |
| Font family                            | `theme.json` → `settings.typography.fontFamilies` |
| Font sizes                             | `theme.json` → `settings.typography.fontSizes`    |
| Default body text color                | `theme.json` → `styles.color`                     |
| Heading styles (h1–h6)                 | `theme.json` → `styles.elements.h1` (etc.)        |
| Button style                           | `theme.json` → `styles.elements.button`           |
| Link color                             | `theme.json` → `styles.elements.link`             |
| Max content width                      | `theme.json` → `settings.layout.contentSize`      |
| Header layout / nav / logo             | `parts/header.html`                               |
| Footer                                 | `parts/footer.html`                               |
| Blog home layout / posts per page      | `templates/index.html`                            |
| Single post layout                     | `templates/single.html`                           |
| Single page layout                     | `templates/page.html`                             |
| 404 page                               | `templates/404.html`                              |
| Theme name/description/version         | `style.css` (header comment only)                 |
| Theme support flags (logo, etc.)       | `functions.php`                                   |

## Glossary (minimum viable)

- **Block theme / FSE** — A WordPress theme where every layout is built from blocks. Templates are HTML files with block comment markers, not PHP.
- **Template** — A top-level layout for a type of page (e.g., `single.html` for one post). Lives in `templates/`.
- **Template part** — A reusable chunk included by templates (e.g., `header.html`). Lives in `parts/`.
- **`theme.json`** — The declarative config file where all global design tokens live. Version 3 is current.
- **Block comment marker** — `<!-- wp:paragraph -->...<!-- /wp:paragraph -->`. These are NOT HTML comments — WordPress parses them as block declarations. Never strip them.
- **Semantic slug** — In `theme.json`, colors/fonts are named by purpose (`primary`, `sans`) not by value (`blue`, `helvetica`) so the user's intent maps directly to the slug.

## Example prompts that work

1. **"Change the primary color to forest green."**
   → Edit `theme.json`, find the palette entry with `"slug": "primary"`, change its `color` to `#228B22` (or equivalent). That's it — the change propagates everywhere because all blocks reference `var(--wp--preset--color--primary)`.

2. **"Add a search block to the header."**
   → Edit `parts/header.html`. Inside the existing `wp:group` flex container, add `<!-- wp:search {"buttonText":"Search"} /-->` after the navigation block.

3. **"Make the blog home show 6 posts per page instead of 10."**
   → Edit `templates/index.html`. Find the `wp:query` block and change `"perPage":10` to `"perPage":6` in the JSON attributes.

4. **"Add a featured image at the top of single posts."**
   → Edit `templates/single.html`. Before the `wp:post-title` block, add `<!-- wp:post-featured-image /-->`.

## How to validate a change

After any edit, the user should:
1. Reload the frontend (`/`) and any affected page type.
2. Open `/wp-admin/site-editor.php` and look at the template — WP will re-render it.
3. If something looks broken, undo the change and try smaller steps.

If the user reports that the site went white or shows a fatal error, the most likely culprit is a broken block comment marker in an HTML template. Look for unclosed `<!-- wp:xxx -->` tags or malformed JSON inside them.

## Local file map

```
vibe-theme/
├── style.css          # theme header (required by WP)
├── theme.json         # ALL global design lives here
├── functions.php      # tiny — theme supports only
├── index.php          # WordPress fallback, do not touch
├── templates/
│   ├── index.html     # blog home
│   ├── single.html    # one blog post
│   ├── page.html      # one WordPress page
│   └── 404.html       # not found
└── parts/
    ├── header.html    # site header + nav
    └── footer.html    # site footer
```

That's the whole theme. Short, flat, boring — by design. If you can't find where to make a change, it's probably in `theme.json`.
