<?php
/**
 * Add dynamic styles
 */
function demure_custom_styles( $custom ) {
	global $demure_config;
	$custom = '';
	
	$accent = '#3c5267';
	$accenthov = '#328CC1';
	$opacity = '0.8';
	$site_info = '#222';
	$site_info_color = '#fff';
	$footer_color = '#333';

	if ( isset( $demure_config ) ) {
		$accent = $demure_config['accent_color']['regular'];
		$accenthov = $demure_config['accent_color']['hover'];
		$opacity = $demure_config['header-opacity'];
		$site_info = $demure_config['site-info-background'];
		$site_info_color = $demure_config['site-info-color'];
		$footer_color = $demure_config['footer-background'];
	}

	/**
	 * Regular accent color
	 */
	$custom .= "ins, html input[type='button'], input[type='reset'], input[type='submit'], .button, form.search-form button, .de_modal .close:hover, .jFiler-theme-default .jFiler-input-button, #cboxPrevious, #cboxNext, #cboxClose { background:" . esc_attr( $accent ) . "}"."\n";
	$custom .= "blockquote { border-left: 5px solid " . esc_attr( $accent ) . "}"."\n";
	$custom .= "#secondary .widget_calendar table tfoot td a, #secondary .widget_calendar table a, .de_modal .close { color:" . esc_attr( $accent ) . "}"."\n";
	$custom .= "#secondary .widget_calendar table #today { border: 3px solid " . esc_attr( $accent ) . "}"."\n";
	$custom .= "form.search-form .search-field { border-top: 1px solid " . esc_attr( $accent ) . "; border-left: 1px solid " . esc_attr( $accent ) . "; border-bottom: 1px solid " . esc_attr( $accent ) . ";}"."\n";
	$custom .= "#masthead .branding h1 a, #masthead .main-navigation ul > li > a:not(:hover), #masthead .menu-toggle:not(:hover) { opacity:" . esc_attr( $opacity ) . "}"."\n";

	/**
	 * Hover accent color
	 */
	$custom .= "form.search-form:hover button, html input[type='button']:hover, input[type='reset']:hover, input[type='submit']:hover, .button:hover, .jFiler-theme-default .jFiler-input-button:hover, .main-navigation ul.sub-menu li:hover, .main-navigation ul.children li:hover, .homepage-slider .owl-buttons .owl-prev:hover, .homepage-slider .owl-buttons .owl-next:hover, #cboxPrevious:hover, #cboxNext:hover, #cboxClose:hover { background:" . esc_attr( $accenthov ) . "}"."\n";
	$custom .= "form.search-form:hover .search-field { border-top: 1px solid " . esc_attr( $accenthov ) . "; border-left: 1px solid " . esc_attr( $accenthov ) . "; border-bottom: 1px solid " . esc_attr( $accenthov ) . ";}"."\n";

	/**
	 * Footer
	 */
	$custom .= "footer .site-info { background:" . esc_attr( $site_info ) . "; color:" . esc_attr( $site_info_color ) . "}"."\n";
	$custom .= "#colophon { background:" . esc_attr( $footer_color ) . "}"."\n";
	
	/**
	 * Output all the styles
	 */
	wp_add_inline_style( 'demure-style', $custom );
}
add_action( 'wp_enqueue_scripts', 'demure_custom_styles' );