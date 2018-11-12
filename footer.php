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

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( function_exists( '_s_social_media_links') ) :
			_s_social_media_links(); 
		endif; ?>

		<nav id="site-navigation" class="secondary-navigation" role="navigation">
			<?php wp_nav_menu( 
				array( 
					'theme_location' 	=> 'secondary', 
					'menu_id' 			=> 'secondary-menu',
					'menu_class' 		=> 'menu',
					'container'			=> 'ul', 
				) 
			); ?>
		</nav><!-- #site-navigation -->

		<p>&copy; <?php echo date("Y"); ?><?php bloginfo('name'); ?></p>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
