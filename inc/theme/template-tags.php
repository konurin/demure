<?php

if ( ! function_exists( 'demure_get_search_heading' ) ) {
	function demure_get_search_heading() {
		$search_result = get_search_query();
		?>
			<div class="search-section-heading"><h1><?php esc_html_e( 'Search result for', 'demure' ); ?>: <?php echo esc_html( $search_result ); ?></h1></div>
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