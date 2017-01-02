<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package demure
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php demure_post_thumbnail(); ?>
	<?php demure_post_header(); ?>
	<?php demure_post_content(); ?>
</article><!-- #post-## -->
