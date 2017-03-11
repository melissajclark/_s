<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _s
 */

if ( ! function_exists( '_s_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function _s_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', '_s' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', '_s' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( '_s_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function _s_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', '_s' ) );
		if ( $categories_list && _s_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', '_s' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', '_s' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', '_s' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', '_s' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', '_s' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function _s_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( '_s_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( '_s_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so _s_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so _s_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in _s_categorized_blog.
 */
function _s_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( '_s_categories' );
}
add_action( 'edit_category', '_s_category_transient_flusher' );
add_action( 'save_post',     '_s_category_transient_flusher' );


/**
 *
 * ##404 Page Content
 *
 * For the 404 Error Page. Content is editable via the Customizer panel, with fallback content if client does not edit it.
 *
 * See 404.php for where it is used. 
 */

if ( ! function_exists( '_s_404_page' ) ) :

function _s_404_page() { 
	
	 $_s_404_headline 		= get_theme_mod('_s_404_headline'); 
	 $_s_404_subheadline	= get_theme_mod('_s_404_subheadline'); 
	 $_s_404_message 		= get_theme_mod('_s_404_content'); ?>

	<article class="error-404 not-found">
		<header class="page-header">
			<?php if (  $_s_404_headline ) : 
					
				echo '<h1 class="page-title">', wp_kses_post(  $_s_404_headline ), '</h1>';

			else :

				echo '<h1 class="page-title">', esc_html_e( 'Not found', '_s_' ), '</h1>';

			endif; ?>
		</header><!-- .page-header -->

		<section class="page-content">
			<?php if ( $_s_404_subheadline ) : 
					
				echo '<h2>', $_s_404_subheadline, '</h2>';

			endif;

			if ( $_s_404_message ) :
					
				echo '<p>', $_s_404_message, '</p>';

			else : 

				echo '<p>', esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', '_s_' ), '</p>';

			endif; ?>
		</section><!-- .page-content -->
	</article><!-- .error-404 -->

	<aside id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</aside><!-- #secondary -->

<?php } // 404 function
endif; // function exists

/**
 *
 * ##Search Page: No Results
 *
 * For the no results search page. Content is editable via the Customizer panel, with fallback content if client does not edit it.
 */

if ( ! function_exists( '_s_search_page' ) ) :

function _s_search_page() { 
	
	 $_s_search_page_headline 		= get_theme_mod('_s_search_page_headline'); 
	 $_s_search_page_message 		= get_theme_mod('_s_search_page_content'); ?>

	<article class="error-404 not-found">
		<header class="page-header">
			<?php if ( $_s_search_page_headline ) : 
					
				echo '<h1 class="page-title">' , wp_kses_post( $_s_search_page_headline ) , '</h1>';

			else :

				echo '<h1 class="page-title">' , esc_html_e( 'Not found', '_s_' ) , '</h1>';

			endif; ?>
		</header><!-- .page-header -->

		<section class="page-content">
			<?php if ( $_s_search_page_message ) :
					
				echo '<p>', $_s_search_page_message, '</p>';

			else : 

				echo '<p>', esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help?', '_s_' ), '</p>';

			endif; ?>
		</section><!-- .page-content -->
	</article><!-- .error-404 -->

<?php } // 404 function
endif; // function exists


/**
 *
 * ##Search Page: With Results
 *
 * Outputs the number of results found and the search term. 
 * 
 * See search.php for where it is used. 
 *
 */

if ( ! function_exists( '_s_search_results_message' ) ) :

function _s_search_results_message() { 
	
	global $wp_query;
	$_s_search_results = $wp_query->found_posts; 

	if ( $_s_search_results < 1 ) :

		echo $_s_search_results, esc_html_e(' Search result for "'),  get_search_query() . '"';

	elseif ( $_s_search_results > 1 ) :

		echo $_s_search_results, esc_html_e(' Search results for "'),  get_search_query() . '"';

	endif;

 } // _s_search_results_message function
endif; // function exists

/**
 *
 * Global Content: ##Social Media Links 
 *
 */

if ( ! function_exists( '_s_social_media_links' ) ) :

function _s_social_media_links() { 

	// Social Profiles URLs
	$_s_social_media_profile_facebook 		= get_theme_mod('_s_social_media_profile_facebook');
	$_s_social_media_profile_linkedin 		= get_theme_mod('_s_social_media_profile_linkedin');
	$_s_social_media_profile_pinterest 		= get_theme_mod('_s_social_media_profile_pinterest');

	// Social Profiles Usernames -> URLs
	$_s_social_media_profile_twitter 		= get_theme_mod('_s_social_media_profile_twitter'); 
	$_s_social_media_profile_twitter_url 	= esc_url( 'https://twitter.com/' . $_s_social_media_profile_twitter );

	$_s_social_media_profile_instagram 		= get_theme_mod('_s_social_media_profile_instagram'); 
	$_s_social_media_profile_instagram_url 	= esc_url( 'https://instagram.com/' . $_s_social_media_profile_instagram ); 

	 echo '<ul class="social-links">';

		if ( $_s_social_media_profile_facebook ) :
			
			echo '<li><a href="', esc_url( $_s_social_media_profile_facebook ) , '">', esc_html_e('Facebook', '_s'), '</a>';

		endif;

		if ( $_s_social_media_profile_instagram ) :
			
			echo '<li><a href="', $_s_social_media_profile_instagram_url  , '">', esc_html_e('Instagram', '_s'), '</a>';

		endif;

		if ( $_s_social_media_profile_linkedin ) :
			
			echo '<li><a href="', esc_url( $_s_social_media_profile_linkedin ) , '">', esc_html_e('LinkedIn', '_s'), '</a>';

		endif;

		if ( $_s_social_media_profile_pinterest ) :
			
			echo '<li><a href="', esc_url( $_s_social_media_profile_pinterest ) , '">', esc_html_e('Pinterest', '_s'), '</a>';

		endif;

		if ( $_s_social_media_profile_twitter ) :
			
			echo '<li><a href="', $_s_social_media_profile_twitter_url , '">', esc_html_e('Twitter', '_s'), '</a>';

		endif;

	echo '</ul>';

} // social links

endif; // function exists