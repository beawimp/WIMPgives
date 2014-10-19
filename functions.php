<?php
/**
 * WIMPgives 2014 functions and definitions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * @package WIMPgives 2014
 * @since   0.1.0
 */

// Useful global constants
define( 'WG2014_VERSION', '0.1.0'                   );
define( 'WG2014_URL', get_template_directory_uri()  );
define( 'WG2014_PATH', dirname( __FILE__ ) . '/'    );
define( 'WG2014_ASSETS', WG2014_URL . 'assets/'     );
define( 'WG2014_INCLUDES', WG2014_PATH . 'includes' );

include_once( 'includes/theme-helpers.php' );
/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @uses  load_theme_textdomain() For translation/localization support.
 *
 * @since 0.1.0
 */
function wg2014_setup() {
	/**
	 * Makes WIMPgives 2014 available for translation.
	 *
	 * Translations can be added to the /lang directory.
	 * If you're building a theme based on WIMPgives 2014, use a find and replace
	 * to change 'wg2014' to the name of your theme in all template files.
	 */
	load_theme_textdomain( 'wg2014', WG2014_PATH . '/languages' );

	/**
	 * Register our WP Menus
	 */
	register_nav_menu( 'primary', 'Primary Navigation' );
	//register_nav_menu( 'footer', 'Footer Navigation' );

	// Clean up the head
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );

	add_theme_support( 'automatic-feed-links' );

	// Enable the Featured Image meta box
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'wg2014_setup' );

/**
 * Enqueue scripts and styles for front-end.
 *
 * @since 0.1.0
 */
function wg2014_scripts_styles() {
	$postfix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style( 'wg2014', WG2014_URL . "/assets/css/wimpgives{$postfix}.css", array(), WG2014_VERSION );

	wp_enqueue_script( 'fw-modernizer', WG2014_URL . '/assets/js/vendor/modernizr-2.5.3.custom.min.js', null, '2.0.6', false );
	wp_enqueue_script( 'superfish', WG2014_URL . '/assets/js/vendor/jquery.superfish.1.4.8.min.js', array( 'jquery' ), '1.4.8', true );
	wp_enqueue_script( 'supersubs', WG2014_URL . '/assets/js/vendor/jquery.supersubs.0.2b.min.js', array( 'superfish' ), '0.2b', true );
	wp_enqueue_script( 'wg2014', WG2014_URL . "/assets/js/wimpgives{$postfix}.js", array( 'supersubs' ), WG2014_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'wg2014_scripts_styles' );

/**
 * Initialize our widgets
 */
function wimpgives_widgets_init() {
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidbar-widget',
		'description'   => 'Place widgets for the sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	) );
}
add_action( 'widgets_init', 'wimpgives_widgets_init' );

/**
 * Add humans.txt to the <head> element.
 */
function wg2014_header_meta() {
	$humans = '<link type="text/plain" rel="author" href="' . WG2014_URL . '/humans.txt" />';

	echo apply_filters( 'wg2014_humans', $humans );
}
add_action( 'wp_head', 'wg2014_header_meta' );