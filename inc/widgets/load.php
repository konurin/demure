<?php
// Register and load widgets
function demure_wodgets_load() {
	register_widget( 'demure_popular_widget' );
}
add_action( 'widgets_init', 'demure_wodgets_load' );