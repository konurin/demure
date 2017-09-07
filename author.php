<?php
/**
 * The template for displaying author page
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package demure
 */

get_header(); ?>

	<div class="user-profile-page">
		<div class="col-md-12">
			<div class="profile-informations">
				<?php demure_get_all_user_posts(); ?>
			</div>
		</div>
	</div>
	
<?php
get_footer();