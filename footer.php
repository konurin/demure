<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package demure
 */

?>
		</div><!-- #row -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<?php demure_get_footer_columns(); ?>
			<?php if ( footer_has_text_and_social() ): ?>
				<div class="site-info">
					<?php demure_footer_text(); ?>
					<?php demure_get_social(); ?>
				</div><!-- .site-info -->
			<?php endif; ?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
