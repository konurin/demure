<?php
/**
 * Template for displaying search forms in demure
 *
 * @package WordPress
 * @subpackage Demure
 * @since Demure 1.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( esc_url( home_url( '/' ) ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'demure' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"></button>
</form>
