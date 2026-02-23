# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

WordPress site for "Stará Kotelna" (a Czech restaurant/cafe), hosted on Wedos.net. This is a traditional WordPress installation with a premium commercial theme — no modern frontend bundlers or package managers are used.

## Architecture

### Theme Stack

- **Active theme:** `grandrestaurant` (parent) + `grandrestaurant-child` (override, currently only imports parent CSS)
- **Parent theme:** Grand Restaurant v7.0.10 by ThemeGoods — a premium Envato/ThemeForest theme
- **Framework:** Proprietary ThemeGoods framework with Kirki Customizer integration
- **No CSS preprocessors** — plain CSS with PHP-based minification (`lib/cssmin.lib.php`, `lib/jsmin.lib.php`)
- **JavaScript:** jQuery-based (`custom.js`), plus third-party libs (FlexSlider, Masonry, Isotope, Magnific Popup)

### Parent Theme Structure (`wp-content/themes/grandrestaurant/`)

- `functions.php` — main entry point (~1,800 lines), loads all `/lib` modules
- `lib/` — 18 PHP library files forming the theme framework:
  - `config.lib.php` — constants (THEMENAME, SHORTNAME "pp", THEMEVERSION)
  - `custom.lib.php` — custom functions
  - `customizer.lib.php` — Kirki-based theme customizer options
  - `admin.lib.php` — admin UI extensions
  - `theme.filter.lib.php` — WordPress filters/hooks
  - `contentbuilder.shortcode.lib.php` — shortcode definitions
  - `widgets.lib.php` — custom widgets
  - `tgm.lib.php` — required plugin enforcement
  - `gutenberg.lib.php` — block editor compatibility
- `modules/` — Kirki framework, content builder
- `templates/` — reusable template partials (header variants, menus, sidebars, sharing)
- `page.fields.php` — custom page meta fields (not ACF — proprietary field system)

### Template Naming Conventions

The theme uses suffix-based layout variants:
- `*_f.php` — full-width layout
- `*_l.php` — left sidebar layout
- `*_r.php` — right sidebar layout
- `*_g*.php` — gallery/grid layouts (e.g., `blog_gs.php` = grid small)

### Custom Post Types

Registered by the `grandrestaurant-custom-post` plugin:
- `galleries` — image galleries
- `menus` — restaurant menus
- `testimonials` — client testimonials
- `team` — team members
- `pricing` — pricing tables

### Key Plugins

- **Elementor** — primary page builder
- **grandrestaurant-elementor** — custom Elementor widgets for the theme
- **WooCommerce** — e-commerce (with native theme support)
- **Contact Form 7** — forms
- **Revolution Slider** (`revslider`) — sliders/carousels
- **MotoPress Appointment Lite** — booking system

### Page Building

Two page-building systems coexist:
1. **Elementor** (primary, plugin-based)
2. **Custom Content Builder** (theme-built, shortcode-based, AJAX-driven via `modules/content_builder.php`)

## Configuration

- **DB host:** `md394.wedos.net` (remote, Czech hosting)
- **Theme option prefix:** `pp_` (SHORTNAME constant)
- **WP_DEBUG:** disabled in production config
- **Permalinks:** configured via `.htaccess`

## Working with the Child Theme

All customizations should go in `wp-content/themes/grandrestaurant-child/`. The child theme currently only contains `style.css` that imports the parent. Add `functions.php` or template overrides there to avoid losing changes on parent theme updates.
