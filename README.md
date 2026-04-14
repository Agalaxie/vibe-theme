# vibe-theme

> **The first WordPress block theme designed to be modified by AI.**
> Built for devs who vibe-code with Claude, Cursor, or the WordPress MCP server.

---

## What is this?

vibe-theme is a minimal WordPress Full Site Editing (FSE) block theme where **every file is documented for an LLM audience**. Point Claude Code, Cursor, or any AI coding assistant at the repo and ask it to customize your site — the theme tells the AI exactly what to edit.

- **LLM-first design.** A root-level `AGENTS.md` explains the whole theme to any AI assistant. Every file has a `@vibe-*` comment header that says what's safe to change.
- **Twelve files total.** The whole theme fits in one LLM context window. No build step. No `node_modules`. No magic.
- **Semantic `theme.json`.** Colors are named `primary` / `secondary` / `accent`, fonts are `sans` / `serif`, sizes are `sm` / `base` / `lg`. User intent maps directly to config.
- **Zero dependencies.** Pure WordPress 6.5+. Works out of the box.

## Install

### Option A — Download the zip

1. Download the latest release zip from the [Releases page](../../releases).
2. In WordPress: **Appearance → Themes → Add New → Upload Theme**.
3. Select the zip and click **Install Now**, then **Activate**.

### Option B — Clone into `wp-content/themes/`

```bash
cd wp-content/themes/
git clone https://github.com/Agalaxie/vibe-theme.git
```
Then activate it from **Appearance → Themes**.

## How to talk to your AI about this theme

Open the project in Claude Code, Cursor, or any AI coding assistant. The assistant will read `AGENTS.md` automatically (or you can point it there explicitly: *"Read AGENTS.md first, then help me change the primary color."*).

Example prompts that work:

- *"Change the primary color to forest green."*
- *"Add a search icon to the header."*
- *"Make the blog home show 6 posts per page instead of 10."*
- *"Add a featured image block at the top of single posts."*
- *"Replace the site title with a logo image."*

The AI will know exactly which file to edit because the theme tells it.

## Project philosophy

- **LLM-friendly first, human-friendly second.** Every file is self-describing via comment headers.
- **Declarative over imperative.** Anything that can live in `theme.json` lives in `theme.json`.
- **Flat over nested.** No `src/`, no `assets/`, no `inc/`. What you see is what WordPress sees.
- **Small over configurable.** v0.1 has 12 files. If you want more templates, that's v0.2.

## Requirements

- WordPress 6.5 or later
- PHP 7.4 or later

## License

GPL-2.0-or-later. See [LICENSE](LICENSE).

## Status

**v0.1.0** — MVP. Shipping fast to gather feedback. Not yet on the WordPress.org directory.

## Roadmap

- v0.2 — Semantically named block patterns (`hero-with-cta`, `pricing-3-columns`, etc.)
- v0.3 — Extra templates (archive, search, author), style variations (light/dark)
- v0.4 — Native WordPress MCP server config file shipped with the theme
- v1.0 — Submit to the WordPress.org theme directory

## Contributing

Issues and PRs welcome. If you're using vibe-theme with an AI assistant and something trips it up, [open an issue](../../issues) with the prompt you used and what happened.

## Author

Built by [Stephane Dumazert](https://github.com/Agalaxie).
