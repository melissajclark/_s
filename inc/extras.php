<?php
/**
 * Custom functions for this theme.
 * *
 * @package _s
 */

 /**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _s_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', '_s_body_classes' );

/**
 * Enqueue login page scripts and styles.
 */
 
function _s_wp_login_page_styling() {
    wp_enqueue_style('admin-style', get_template_directory_uri() . '/assets/css/login-style.css', false);
}
add_action('login_enqueue_scripts', '_s_wp_login_page_styling');

/**
 *
 * Pages: Add Excerpt Support
 * https://codex.wordpress.org/Function_Reference/add_post_type_support
 *
 */

add_post_type_support('page', 'excerpt');

/**
 *
 * Set Default image link option to none
 *
 */

update_option('image_default_link_type','none');

/**
 *
 * WordPress Login Page: Home URL
 *
 */

if ( ! function_exists( '_s_wp_login_url' ) ) :
    function _s_wp_login_url() {
        return home_url();
    }
endif; // function_exists
add_filter( 'login_headerurl', '_s_wp_login_url' );

/**
*
* Filter Yoast SEO's settings, so it is below custom metaboxes.
* https://wordpress.org/support/topic/plugin-wordpress-seo-by-yoast-position-seo-meta-box-priority-above-custom-meta-boxes/
*
*/

add_filter( 'wpseo_metabox_prio', function() { return 'low';});