<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package demure
 */
 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php demure_post_thumbnail(); ?>
	<?php demure_post_header(); ?>
	<?php demure_get_post_meta(); ?>
	<?php demure_post_content(); ?>
	<?php demure_post_footer(); ?>
</article><!-- #post-## -->
