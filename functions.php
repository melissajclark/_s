<?php
/**
 * _s functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

if ( ! function_exists( '_s_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _s_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	// add_image_size( '_s_image_square', 750, 750, array( 'left', 'top' ) );

	// Register the three useful image sizes for use in Add Media modal
	// add_filter( 'image_size_names_choose', '_s_custom_image_sizes' );

	// function _s_custom_image_sizes( $sizes ) {
	// 	return array_merge( $sizes, array(
	// 		'_s_image_square' 		=> __( 'Large Square - 750px' ),
	// 	) );
	// }

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' 	=> esc_html__( 'Header', '_s' ),
		'secondary' => esc_html__( 'Footer', '_s' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 *
	 * Add support for Gutenberg / Block Editor features
	 *
	 * @link https://www.billerickson.net/getting-your-theme-ready-for-gutenberg/
	 * @link https://www.billerickson.net/wordpress-color-palette-button-styling-gutenberg/
	 * 
	 */
	add_theme_support( 'align-wide' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( './assets/css/editor-style.css' );

	// Colour palette
	add_theme_support( 'editor-color-palette', array(

		array(
			'name'  => __( 'White', '_s' ),
			'slug'  => 'white',
			'color' => '#FFFFFF',
		),
		
		array(
			'name'  => __( 'Black', '_s' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
		
	) ); // custom colour palette

	/**
	 *
	 * Disable unwanted Block Editor features
	 *
	 */
	add_theme_support( 'disable-custom-font-sizes' );
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'disable-custom-gradients' );
	add_theme_support( 'editor-gradient-presets', array() );

}
endif;
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _s_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_s_content_width', 1000 );
}
add_action( 'after_setup_theme', '_s_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _s_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', '_s' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', '_s' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', '_s_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _s_scripts() {

	wp_enqueue_style( 
	    '_s-style', 
	    get_stylesheet_directory_uri() . '/assets/css/style.css',
	    array(),
	    false
	    //'###' // version number
	 );

	wp_enqueue_script( 
		'_s-skip-link-focus-fix', // handle (name)
		get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', // file location
		array(), // dependencies
		'20151215', // version number
		true // load in footer 
	);

	wp_enqueue_script( 
		'_s-navigation', // handle (name)
		get_template_directory_uri() . '/assets/js/navigation.js', // file location
		array(), // dependencies
		'20151215', // version number
		true // load in footer 
	);

	// wp_enqueue_script( 
	// 	'object-fit-polyfill', // handle (name)
	// 	get_template_directory_uri() . '/assets/js/object-fit-polyfill.js', // file location
	// 	array(), // dependencies
	// 	null, // version number
	// 	true // load in footer 
	// );

	// wp_enqueue_script( 
	// 	'fitvid', // handle (name)
	// 	get_template_directory_uri() . '/assets/js/fitvid.js', // file location
	// 	array(), // dependencies
	// 	null, // version number
	// 	true // load in footer 
	// );
	
	wp_enqueue_script( 
		'plugins', // handle (name)
		get_template_directory_uri() . '/assets/js/plugins.js', // file location
		array(), // dependencies
		null, // version number
		true // load in footer 
	);

	wp_enqueue_script( 
		'theme', // handle (name)
		get_template_directory_uri() . '/assets/js/theme.js', // file location
		array('jquery', 'plugins'), // dependencies
		null, // version number
		true // load in footer 
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_s_scripts' );

/**
 * Block editor scripts
 * @link https://www.billerickson.net/block-styles-in-gutenberg/
 */
function _s_blockeditor_scripts() {

	wp_enqueue_script(
		'_s-editor-js', 
		get_stylesheet_directory_uri() . '/assets/js/block-editor.js', 
		array( 'wp-blocks', 'wp-dom', 'jquery'), 
		filemtime( get_stylesheet_directory() . '/assets/js/block-editor.js' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', '_s_blockeditor_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
