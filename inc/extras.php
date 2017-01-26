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
 	add_editor_style( 'editor-style.css' );
 }
 add_action( 'admin_init', '_s_add_editor_styles' );

/**
*
* Filter Yoast SEO's settings, so it is below custom metaboxes.
* https://wordpress.org/support/topic/plugin-wordpress-seo-by-yoast-position-seo-meta-box-priority-above-custom-meta-boxes/
*
*/

add_filter( 'wpseo_metabox_prio', function() { return 'low';});

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
 * TypeKit Fonts
 *
 * https://wptheming.com/2013/02/typekit-code-snippet/
 */

// function _s_typekit() {
//     wp_enqueue_script( '_s_typekit', '//use.typekit.net/TYPEKITCODE.js');
// }
// add_action( 'wp_enqueue_scripts', '_s_typekit' );

// function _s_typekit_inline() {
//   if ( wp_script_is( '_s_typekit', 'done' ) ) { // ?>
<!-- //     <script type="text/javascript">try{Typekit.load();}catch(e){}</script> -->
<?php // }
// }
// add_action( 'wp_head', '_s_typekit_inline' );