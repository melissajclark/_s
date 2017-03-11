<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _s
 */

 /**
 *
 * Add an editor stylesheet to the WordPress admin
 * See: https://developer.wordpress.org/reference/functions/add_editor_style/
 *
 **/

 function _s_add_editor_styles() {
 	add_editor_style( './assets/css/editor-style.css' );
 }
 add_action( 'admin_init', '_s_add_editor_styles' );

 /**
 * Enqueue admin scripts and styles.
 */
function _s_wp_admin_styling() {
    wp_enqueue_style('admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', false);
}
add_action('admin_enqueue_scripts', '_s_wp_admin_styling');

/**
 * Enqueue login page scripts and styles.
 */
 
function _s_wp_login_page_styling() {
    wp_enqueue_style('admin-style', get_template_directory_uri() . '/assets/css/login-style.css', false);
}
add_action('login_enqueue_scripts', '_s_wp_login_page_styling');

/**
 *
 * Add Formats drop-down to WP Editor
 *
 */

function _s_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons', '_s_mce_editor_buttons' );

/**
 *
 * Populate Formats with custom style options
 *
 */
function _s_mce_before_init( $settings ) {
    $style_formats = array(
        array(
            'title' => 'Button',
            'selector' => 'a',
            'classes' => 'button'
        ),

    );
    $settings['style_formats'] = json_encode( $style_formats );
    return $settings;
}
add_filter( 'tiny_mce_before_init', '_s_mce_before_init' );

/**
 *
 * Always show the second row of buttons
 *
 */

function _s_show_toolbar( $args ) {
    $args['wordpress_adv_hidden'] = false;
    return $args;
}
add_filter( 'tiny_mce_before_init', '_s_show_toolbar' );


// remove the toolabr toggle since we're always showing the second row of buttons
function _s_hide_toolbar_toggle( $buttons ) {
    $remove = 'wp_adv';
    $key = array_search( $remove, $buttons );
    if ( $key ) {
        unset( $buttons[$key] );
    }
    return $buttons;
}
add_filter( 'mce_buttons', '_s_hide_toolbar_toggle' );

/**
 *
 * Pages: Add Excerpt Support
 * https://codex.wordpress.org/Function_Reference/add_post_type_support
 *
 */

add_post_type_support('page', 'excerpt');

/**
 *
 * Remove the <p> tags around images
 *
 */

function _s_filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', '_s_filter_ptags_on_images');

/**
 *
 * Add brand colours to the WP Editor
 *
 */

function _s_change_tinymce_colours( $args ) {
    $custom_colours = '
        "333333", "Dark grey",
        "d3d3d3", "Medium grey",
        "f5f5f5", "Light grey"
    ';
     $args['textcolor_map'] = '[' . $custom_colours . ']';
     return $args;
}
add_filter( 'tiny_mce_before_init', '_s_change_tinymce_colours' );

/**
 *
 * Enable SVG Support
 *
 */

function _s_allow_svg_upload($mimes) {
	$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
add_filter('upload_mimes', '_s_allow_svg_upload');


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

/**
 * TypeKit Fonts
 *
 * https://wptheming.com/2013/02/typekit-code-snippet/
 */
