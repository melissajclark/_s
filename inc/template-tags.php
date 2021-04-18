<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _s
 */

if ( ! function_exists( '_s_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function _s_posted_on() {
		$_s_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$_s_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$_s_time_string = sprintf( $_s_time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="posted-on">' . $_s_time_string  . '</span>'; 

	}
}

if ( ! function_exists( '_s_posted_by' ) ) {
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function _s_posted_by() {
		$_s_byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', '_s' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $_s_byline . '</span>'; 

	}
}

if ( ! function_exists( '_s_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function _s_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$_s_categories_list = get_the_category_list( esc_html__( ', ', '_s' ) );
			if ( $_s_categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', '_s' ) . '</span>', $_s_categories_list ); 
			}

			/* translators: used between list items, there is a space after the comma */
			$_s_tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', '_s' ) );
			if ( $_s_tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', '_s' ) . '</span>', $_s_tags_list ); 
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', '_s' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', '_s' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}

/**
 *
 * ##404 Page Content
 *
 * For the 404 Error Page. Content is editable via the Customizer panel, with fallback content if client does not edit it.
 *
 * See 404.php for where it is used. 
 */

if ( ! function_exists( '_s_404_page' ) ) {

function _s_404_page() { 
	
	 $_s_404_headline 		= get_theme_mod('_s_404_headline'); 
	 $_s_404_subheadline	= get_theme_mod('_s_404_subheadline'); 
	 $_s_404_message 		= get_theme_mod('_s_404_content'); ?>

	<article class="error-404 not-found">
		<header class="page-header">
			<?php if ( !empty( $_s_404_headline ) ) { 
					
				echo '<h1 class="page-title">', esc_html(  $_s_404_headline ) . '</h1>';

			} else {

				echo '<h1 class="page-title">' . esc_html__( 'Not found', '_s' ) .'</h1>';

			} ?>
		</header><!-- .page-header -->

		<section class="page-content">
			<?php if ( !empty( $_s_404_subheadline ) ) { 
					
				echo '<h2>' . esc_html( $_s_404_subheadline ) . '</h2>';

			}

			if ( !empty( $_s_404_message ) ) {
					
				echo '<p>' . esc_html( $_s_404_message ) . '</p>';

			} else { 

				echo '<p>' . esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', '_s' ) . '</p>';

			} 

			get_search_form(); ?>
		</section><!-- .page-content -->
	</article><!-- .error-404 -->

	<aside id="secondary" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</aside><!-- #secondary -->

<?php } // 404 function
} // function exists

/**
 *
 * ##Search Page: No Results
 *
 * For the no results search page. Content is editable via the Customizer panel, with fallback content if client does not edit it.
 */

if ( ! function_exists( '_s_search_page' ) ) {

function _s_search_page() { 
	
	 $_s_search_page_headline 		= get_theme_mod('_s_search_page_headline'); 
	 $_s_search_page_message 		= get_theme_mod('_s_search_page_content'); ?>

	<article class="error-404 not-found">
		<header class="page-header">
			<?php if ( !empty( $_s_search_page_headline ) ) { 
					
				echo '<h1 class="page-title">' . esc_html( $_s_search_page_headline ) . '</h1>';

			} else {

				echo '<h1 class="page-title">' . esc_html__( 'Not found', '_s' ) . '</h1>';

			} ?>
		</header><!-- .page-header -->

		<section class="page-content">
			<?php if ( !empty( $_s_search_page_message ) ) {
					
				echo '<p>' . esc_html( $_s_search_page_message ) . '</p>';

			} else { 

				echo '<p>' . esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help?', '_s' ) . '</p>';

			} 

			get_search_form(); ?>
		</section><!-- .page-content -->
	</article><!-- .error-404 -->

<?php } // 404 function
} // function exists


/**
 *
 * ##Search Page: With Results
 *
 * Outputs the number of results found and the search term. 
 * 
 * See search.php for where it is used. 
 *
 */

if ( ! function_exists( '_s_search_results_message' ) ) {

function _s_search_results_message() { 
	
	global $wp_query;
	$_s_search_results = $wp_query->found_posts; 

	if ( !empty( $_s_search_results <= 1 ) ) {

		echo esc_html( $_s_search_results ) . esc_html__(' Search result for &ldquo;', '_s') .  get_search_query() . '&rdquo;';

	} elseif ( !empty( $_s_search_results > 1 ) ) {

		echo esc_html( $_s_search_results ) . esc_html__(' Search results for &ldquo;', '_s') .  get_search_query() . '&rdquo;';

	}

 } // pillarlife_search_results_message function
} // function exists

/**
 *
 * Global Content: ##Social Media Links 
 *
 */

if ( ! function_exists( '_s_social_media_links' ) ) {

function _s_social_media_links() { 

	// Social Profiles URLs
	$_s_social_media_profile_facebook 		= get_theme_mod('_s_social_media_profile_facebook');
	$_s_social_media_profile_linkedin 		= get_theme_mod('_s_social_media_profile_linkedin');
	$_s_social_media_profile_pinterest 		= get_theme_mod('_s_social_media_profile_pinterest');

	// Social Profiles Usernames -> URLs
	$_s_social_media_profile_twitter 		= get_theme_mod('_s_social_media_profile_twitter'); 
	$_s_social_media_profile_twitter_url 	= 'https://twitter.com/' . $_s_social_media_profile_twitter;

	$_s_social_media_profile_instagram 		= get_theme_mod('_s_social_media_profile_instagram'); 
	$_s_social_media_profile_instagram_url 	= 'https://instagram.com/' . $_s_social_media_profile_instagram; 

	 echo '<ul class="social-links">';

		if ( !empty( $_s_social_media_profile_facebook ) ) {
			
			echo '<li><a href="' . esc_url( $_s_social_media_profile_facebook )  . '">' . esc_html__('Facebook', '_s') . '</a>';

		}

		if ( !empty( $_s_social_media_profile_instagram ) ) {
			
			echo '<li><a href="' . esc_url( $_s_social_media_profile_instagram_url ) . '">' . esc_html__('Instagram', '_s') . '</a>';

		}

		if ( !empty( $_s_social_media_profile_linkedin ) ) {
			
			echo '<li><a href="' . esc_url( $_s_social_media_profile_linkedin )  . '">' . esc_html__('LinkedIn', '_s') . '</a>';

		}

		if ( !empty( $_s_social_media_profile_pinterest ) ) {
			
			echo '<li><a href="' . esc_url( $_s_social_media_profile_pinterest )  . '">' . esc_html__('Pinterest', '_s') . '</a>';

		}

		if ( !empty( $_s_social_media_profile_twitter ) ) {
			
			echo '<li><a href="' . esc_url( $_s_social_media_profile_twitter_url ) . '">' . esc_html__('Twitter', '_s') . '</a>';

		}

	echo '</ul>';

} // social links

} // function exists