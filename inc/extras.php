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


/**
 * Gravity Forms
 * 
 * Filters the next, previous and submit buttons.
 * Replaces the forms <input> buttons with <button> while maintaining attributes from original <input>.
 *
 * @param string $button Contains the <input> tag to be filtered.
 * @param object $form Contains all the properties of the current form.
 *
 * @return string The filtered button.
 * 
 * @link https://docs.gravityforms.com/gform_submit_button/
 */
add_filter( 'gform_next_button', 'afs_gravity_submit_input_to_button', 10, 2 );
add_filter( 'gform_previous_button', 'afs_gravity_submit_input_to_button', 10, 2 );
add_filter( 'gform_submit_button', 'afs_gravity_submit_input_to_button', 10, 2 );

function afs_gravity_submit_input_to_button( $button, $form ) {
    $dom = new DOMDocument();
    $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
    $input = $dom->getElementsByTagName( 'input' )->item(0);
    $new_button = $dom->createElement( 'button' );
    $new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
    $input->removeAttribute( 'value' );
    foreach( $input->attributes as $attribute ) {
        $new_button->setAttribute( $attribute->name, $attribute->value );
    }
    $input->parentNode->replaceChild( $new_button, $input );
 
    return $dom->saveHtml( $new_button );
}

/**
 *
 * Filter Gravity Forms to add classes to inputs
 *
 * @link https://www.gravityhelp.com/documentation/article/gform_field_css_class/
 */
//  Possible fields: html, hidden, section, text, website, phone, number, date, time, textarea, select, checkbox, radio, name, address, fileupload, email, post_title, post_content, post_excerpt, post_tags, post_category, post_image, post_custom_field, captcha

add_filter( 'gform_field_css_class', '_s_gform_single_inputs', 10, 3 );

function _s_gform_single_inputs( $classes, $field, $form ) {
    if ( $field->type == 'text' || 
		$field->type == 'website' || 
		$field->type == 'email' || 
		$field->type == 'number' || 
		$field->type == 'phone' || 
		$field->type == 'date'|| 
		$field->type == 'post_custom_field' ||
		$field->type == 'post_title' || 
		$field->type == 'select' || 
		$field->type == 'username' || 
		$field->type == 'time') {

        $classes .= ' gravity-input-small';
    }
    return $classes;
}

add_filter( 'gform_field_css_class', '_s_gform_large_input', 10, 3 );

function _s_gform_large_input( $classes, $field, $form ) {
    if ( $field->type == 'address' || 
		$field->type == 'textarea' || 
		$field->type == 'password') {
        $classes .= ' gravity-input-large';
    }
    return $classes;
}