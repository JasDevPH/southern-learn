<?php
/**
 * Southern Learn – minimal functions.
 * Rule: if it isn't needed for performance, SEO, accessibility or maintainability, it doesn't go here.
 */

defined( 'ABSPATH' ) || exit;

// Theme supports.
add_action( 'after_setup_theme', function () {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_editor_style( 'style.css' );
} );

// Pattern category.
add_action( 'init', function () {
	register_block_pattern_category( 'southern-learn', [ 'label' => __( 'Southern Learn', 'southern-learn' ) ] );
} );

// Performance: remove emoji scripts/styles.
add_action( 'init', function () {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
} );

// Skip link for keyboard/screen-reader users (accessibility).
add_action( 'wp_body_open', function () {
	echo '<a class="skip-link" href="#main">' . esc_html__( 'Skip to content', 'southern-learn' ) . '</a>';
} );

// AEO/SEO: Organization structured data (JSON-LD) on the front page.
add_action( 'wp_head', function () {
	if ( ! is_front_page() ) {
		return;
	}
	$data = [
		'@context' => 'https://schema.org',
		'@type'    => 'EducationalOrganization',
		'name'     => get_bloginfo( 'name' ),
		'url'      => home_url( '/' ),
		'areaServed' => 'AU',
	];
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
} );

// Front-end assets: theme stylesheet + one small deferred script (version = file time, so edits are never cached).
add_action( 'wp_enqueue_scripts', function () {
	$dir = get_stylesheet_directory();
	$uri = get_stylesheet_directory_uri();
	wp_enqueue_style( 'southern-learn', get_stylesheet_uri(), [], filemtime( $dir . '/style.css' ) );
	wp_enqueue_script(
		'southern-learn-main',
		$uri . '/assets/main.js',
		[],
		filemtime( $dir . '/assets/main.js' ),
		[ 'strategy' => 'defer', 'in_footer' => true ]
	);
} );
