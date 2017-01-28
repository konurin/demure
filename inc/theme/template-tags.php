<?php
if ( ! function_exists( 'get_user_login_form' ) ) {
	function get_user_login_form() {
		?>
		<div data-name="login-form" class="de_modal">
			<div class="form-wrap">
				<div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
				<form method="post">
					<div class="form-group">
						<label for="user-name"><?php esc_html_e( 'Username or email', 'demure' ) ?></label>
						<input type="text" id="user-name" name="user_login" value="" required="required" />
					</div>
					<div class="form-group">
						<label for="user-pass"><?php esc_html_e( 'Password', 'demure' ) ?></label>
						<input type="password" id="user-pass" name="user_pass" value="" required="required"/>
					</div>
					<div class="form-group">
						<input type="submit" name="demure_user_login" value="<?php esc_html_e( 'Log in', 'demure' ); ?>" />
					</div>
				</form>
			</div>
			<div class="overlay"></div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'get_register_form' ) ) {
	function get_register_form() {
		?>
		<div data-name="register-form" class="de_modal">
			<div class="form-wrap">
				<div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
				<form method="post">
				<div class="form-group">
					<label for="username"><?php esc_html_e( 'Username', 'demure' ) ?></label>
					<input type="text" id="username" name="username" name="login" value="" required="required" />
				</div>
				<div class="form-group">
					<label for="email"><?php esc_html_e( 'Email', 'demure' ) ?></label>
					<input type="email" id="email" name="email" value="" required="required" />
				</div>
				<div class="form-group">
					<label for="password"><?php esc_html_e( 'Password', 'demure' ) ?></label>
					<input type="password" id="password" name="password" value="" required="required"/>
				</div>
				<div class="form-group">
					<label for="first-name"><?php esc_html_e( 'First Name', 'demure' ) ?></label>
					<input type="text" id="first-name" name="first_name" value="" />
				</div>
				<div class="form-group">
					<label for="last-name"><?php esc_html_e( 'Last Name', 'demure' ) ?></label>
					<input type="text" id="last-name" name="last_name" value="" />
				</div>
				<div class="form-group">
					<input type="submit" name="demure_register_form" value="<?php esc_html_e( 'Register', 'demure' ); ?>" />
				</div>
			</form>
			</div>
			<div class="overlay"></div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'secondary_menu' ) ) {
	function secondary_menu() {
		?>
			<nav class="main-navigation" id="secondary-menu">
				<?php if ( is_user_logged_in() ): 
					$profile_link = get_author_posts_url( get_current_user_id() );
					?>
					<ul>
						<li><a href="<?php echo $profile_link; ?>"><?php esc_html_e( 'My profile', 'demure' ) ?></a></li>
						<li><a href="<?php echo wp_logout_url( home_url() ); ?>"><?php esc_html_e( 'Logout', 'demure' ) ?></a></li>
					</ul>
				<?php else : ?>
					<ul>
						<li><a href="#" name="login-form" class="login-button open-modal"><?php esc_html_e( 'Log in', 'demure' ) ?></a></li>
						<li><a href="#" name="register-form" class="open-modal"><?php esc_html_e( 'Registration', 'demure' ) ?></a></li>
					</ul>
				<?php endif; ?>
			</nav>
		<?php
	}
}

if ( ! function_exists( 'get_demure_search_heading' ) ) {
	function get_demure_search_heading() {
		$search_result = get_search_query();
		?>
			<div class="search-section-heading"><h1><?php esc_html_e( 'Search result for', 'demure' ); ?>: <?php echo $search_result; ?></h1></div>
		<?php
	}
}

if ( ! function_exists( 'demure_user_menu' ) ) {
    function demure_user_menu() {
		if ( !is_user_logged_in() ) return false;
        ?>
        <div class="tabs-menu">
            <ul>
                <li><a class="button" href="#author-info"><i class="fa fa-user" aria-hidden="true"></i><?php esc_html_e( 'Author info', 'demure' ); ?></a></li>
                <li><a class="button" href="#author-posts"><i class="fa fa-archive" aria-hidden="true"></i><?php esc_html_e( 'Posts', 'demure' ); ?></a></li>
            </ul>
        </div>
        <?php
    }
}