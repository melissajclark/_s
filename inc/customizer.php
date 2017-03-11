<?php
/**
 * _s Theme Customizer.
 *
 * @package _s
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function _s_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', '_s_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _s_customize_preview_js() {
	wp_enqueue_script( '_s_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', '_s_customize_preview_js' );


/**
 *
 * Sanitize all inputs from the customizer
 *
 */
function _s_customize_sanitize( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 *
 * Customizer: Social Media
 *
 */

function _s_social_media_profiles( $wp_customize ) {
    
    $wp_customize->add_section(
        '_s_social_media_profiles',
        array(
            'title'             => __('Social Media', '_s'),
            'capability'        => 'edit_theme_options',
            'description'       => __('These social media links will be used throughout the website. <br/><br/> To remove a social profile, delete the URL or username. ', '_s'),
            'priority'          => 100,
        )
    );

    /**
     * Facebook
     */

    $wp_customize->add_setting(
        '_s_social_media_profile_facebook',
        array(
            'default' => '',
            'sanitize_callback' => '_s_customize_sanitize',

        )
    );

    $wp_customize->add_control(
        '_s_social_media_profile_facebook',
        array(
            'label'         => __('Facebook', '_s'),
            'description'   => __('Full URL for your Facebook page / profile.', '_s'),
            'section'       => '_s_social_media_profiles',
            'type'          => 'url',
        )
    );

    /**
     * Instagram
     */

    $wp_customize->add_setting(
        '_s_social_media_profile_instagram',
        array(
            'default' => '',
            'sanitize_callback' => '_s_customize_sanitize',

        )
    );

    $wp_customize->add_control(
        '_s_social_media_profile_instagram',
        array(
            'label'         => __('Instagram', '_s'),
            'description'   => __('Username only (no @ symbol)', '_s'),
            'section'       => '_s_social_media_profiles',
            'type'          => 'text',
        )
    );

    /**
     * LinkedIn
     */

    $wp_customize->add_setting(
        '_s_social_media_profile_linkedin',
        array(
            'default' => '',
            'sanitize_callback' => '_s_customize_sanitize',

        )
    );

    $wp_customize->add_control(
        '_s_social_media_profile_linkedin',
        array(
            'label'         => __('LinkedIn', '_s'),
            'description'   => __('Full URL for your LinkedIn page / profile', '_s'),
            'section'       => '_s_social_media_profiles',
            'type'          => 'url',
        )
    );

    /**
     * Pinterest
     */

    $wp_customize->add_setting(
        '_s_social_media_profile_pinterest',
        array(
            'default' => '',
            'sanitize_callback' => '_s_customize_sanitize',

        )
    );

    $wp_customize->add_control(
        '_s_social_media_profile_pinterest',
        array(
            'label'         => __('Pinterest', '_s'),
            'description'   => __('Full URL for your Pinterest page / profile', '_s'),
            'section'       => '_s_social_media_profiles',
            'type'          => 'url',
        )
    );


    /**
     * Twitter
     */

    $wp_customize->add_setting(
        '_s_social_media_profile_twitter',
        array(
            'default' => '',
            'sanitize_callback' => '_s_customize_sanitize',

        )
    );

    $wp_customize->add_control(
        '_s_social_media_profile_twitter',
        array(
            'label'         => __('Twitter', '_s'),
            'description'   => __('Username only (no @ symbol)', '_s'),
            'section'       => '_s_social_media_profiles',
            'type'          => 'text',
        )
    );
}
add_action( 'customize_register', '_s_social_media_profiles' );


/**
 *
 * Customizer: 404 Page
 *
 */

function _s_customize_404_page( $wp_customize ) { 

    $wp_customize->add_section(
        '_s_404_page',
        array(
            'title'             => __('Error Page Content', '_s'),
            'capability'        => 'edit_theme_options',
            'description'       => __('Edit the content displayed on the website\'s error page. <br/> <br/> Use the <em>404 Error Page Sidebar</em> to add widgets to this page.', '_s'),
            'priority'          => 120,
        )
    );

    /**
     * Headline
     */

    $wp_customize->add_setting(
        '_s_404_headline',
        array(
            'default' => __('Oops!', '_s'),
            'sanitize_callback' => '_s_customize_sanitize',

        )
    );

    $wp_customize->add_control(
        '_s_404_headline',
        array(
            'label'         => __('Headline', '_s'),
            'description'   => __('Headline for the 404 Error page.', '_s'),
            'section'       => '_s_404_page',
            'type'          => 'text',
        )
    );

    /**
     * Subheading
     */

    $wp_customize->add_setting(
        '_s_404_subheadline',
        array(
            'default' => __('The page you are looking for Can\'t be found.', '_s'),
            'sanitize_callback' => '_s_customize_sanitize',

        )
    );

    $wp_customize->add_control(
        '_s_404_subheadline',
        array(
            'label'         => __('Subheading', '_s'),
            'description'   => __('Subheading for the 404 Error page.', '_s'),
            'section'       => '_s_404_page',
            'type'          => 'textarea',
        )
    );

    /**
     * Message
     */

    $wp_customize->add_setting(
        '_s_404_content',
        array(
            'default' => __('Try one of the following pages instead:', '_s'),
            'sanitize_callback' => '_s_customize_sanitize',

        )
    );

    $wp_customize->add_control(
        '_s_404_content',
        array(
            'label'         => __('Message', '_s'),
            'description'   => __('Displayed below the headline and subheading for the 404 Error page.', '_s'),
            'section'       => '_s_404_page',
            'type'          => 'textarea',
        )
    );
}

add_action( 'customize_register', '_s_customize_404_page' );

/**
 *
 * Customizer: Search Page
 *
 */

function _s_customize_search_page( $wp_customize ) { 

    $wp_customize->add_section(
        '_s_search_page',
        array(
            'title'             => __('Search Page Content', '_s'),
            'capability'        => 'edit_theme_options',
            'description'       => __('Edit the content displayed on the website\'s search page. <br/> <br/> This page is displayed when nothing is found for the user\'s search term.', '_s'),
            'priority'          => 120,
        )
    );

    /**
     * Headline
     */

    $wp_customize->add_setting(
        '_s_search_page_headline',
        array(
            'default' => __('Oops!', '_s'),
            'sanitize_callback' => '_s_customize_sanitize',

        )
    );

    $wp_customize->add_control(
        '_s_search_page_headline',
        array(
            'label'         => __('Headline', '_s'),
            'description'   => __('Headline for the Search page.', '_s'),
            'section'       => '_s_search_page',
            'type'          => 'text',
        )
    );


    /**
     * Message
     */

    $wp_customize->add_setting(
        '_s_search_page_content',
        array(
            'default' => __('Sorry, but nothing matched your search terms. Please try again with some different keywords.', '_s'),
            'sanitize_callback' => '_s_customize_sanitize',

        )
    );

    $wp_customize->add_control(
        '_s_search_page_content',
        array(
            'label'         => __('Message', '_s'),
            'description'   => __('Displayed below search page\'s headline.', '_s'),
            'section'       => '_s_search_page',
            'type'          => 'textarea',
        )
    );
}

add_action( 'customize_register', '_s_customize_search_page' );