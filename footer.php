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
		<?php _s_social_media_links(); ?>
		<p>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?></p>
		<p><?php printf( esc_html__( 'Website by: %1$s by %2$s.', '_s' ), '_s', '<a href="https://melissajclark.ca">Melissa Jean Clark</a>' ); ?></p>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
