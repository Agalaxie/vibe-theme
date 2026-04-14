<?php
/**
 * @vibe-file: functions.php
 * @purpose: Minimal theme setup — enqueue the style.css theme header and declare basic theme supports. Block themes need very little PHP because theme.json handles most configuration.
 * @safe-to-edit:
 *   - add_theme_support() calls inside vibe_theme_setup()
 *   - wp_enqueue_style() calls inside vibe_theme_enqueue_assets()
 * @do-not-touch:
 *   - this file must stay under 50 lines (vibe-theme philosophy)
 *   - never add business logic here — use a plugin instead
 *   - the 'after_setup_theme' and 'wp_enqueue_scripts' hook names
 * @prompt-examples:
 *   - "Add support for a custom logo"
 *   - "Enqueue a Google Font called Inter"
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function vibe_theme_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	load_theme_textdomain( 'vibe-theme' );
}
add_action( 'after_setup_theme', 'vibe_theme_setup' );

function vibe_theme_enqueue_assets() {
	wp_enqueue_style( 'vibe-theme-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'vibe_theme_enqueue_assets' );
