<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bizbuzz
 */

 /**
  * Hook - bizbuzz_action_before_content.
  *
  * @hooked bizbuzz_main_content_ends - 30
  */
do_action( 'bizbuzz_action_after_content' );

$footer_copyright = bizbuzz_get_option( 'footer_copyright' );
?>

	<footer id="colophon" class="site-footer el-rt-animate fadeInUp">
		<?php do_action( 'bizbuzz_action_before_footer' ); ?>
		
		<div class="site-info">
			<div class="rt-wrapper">
				<div class="rt-footer">
					<?php if ( $footer_copyright ) : ?>
						<p class="copyright-info"><?php echo esc_html( $footer_copyright ); ?></p>
					<?php endif; ?>
					<p class="credit-info">
						<?php
						/* translators: 1: Theme name, 2: Theme author. */
						printf( esc_html__( 'Theme: %1$s by %2$s.', 'bizbuzz' ), 'bizbuzz', '<a href="https://refreshthemes.com" target="_blank">Refresh Themes</a>' );
						?>
					</p>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
