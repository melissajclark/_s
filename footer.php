<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php if ( function_exists( '_s_social_media_links') ) :
			_s_social_media_links(); 
		endif; ?>

		<nav id="site-navigation" class="secondary-navigation">
			<?php if ( has_nav_menu( 'secondary' ) ) {
				wp_nav_menu( 
					array( 
						'theme_location' 	=> 'secondary', 
						'menu_id' 			=> 'secondary-menu',
						'menu_class' 		=> 'secondary-menu menu',
						'container'			=> 'ul', 
					) 
				); 
			} // primary ?>
		</nav><!-- #site-navigation -->

		<p>&copy; <?php echo esc_html( date("Y") ); ?> <?php esc_html(  bloginfo('name') ); ?></p>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
