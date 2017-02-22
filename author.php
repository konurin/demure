<?php get_header(); ?>
	<div class="user-profile-page">
		<div class="col-md-3">
			<?php demure_user_avatar(); ?>
			<?php demure_user_menu(); ?>
		</div>
		<div class="col-md-9">
			<?php if ( is_user_logged_in() ): ?>
				<div id="tabs" class="profile-tabs">
					<div class="row">
						<div class="col-md-12">
							<div class="tabs-content">
								<div id="author-info">
									<?php demure_get_author_info(); ?>
								</div>
								<div id="author-posts">
									<?php demure_get_all_user_posts(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php else: ?>
				<div class="profile-informations">
					<?php demure_get_author_info(); ?>
					<?php demure_get_all_user_posts(); ?>
				</div>
			<?php endif; ?>
		</div>

		
	</div>	
<?php
get_footer();