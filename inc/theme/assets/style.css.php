<?php
	header("Content-type: text/css; charset: UTF-8");
	global $demure_config;

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
	
?>

/* regular accent color */
ins {
    background: <?php echo $accent; ?>;
}

html input[type="button"], 
input[type="reset"], 
input[type="submit"],
.button {
    background: <?php echo $accent; ?>;
}

blockquote {
    border-left: 5px solid <?php echo $accent; ?>;
}

#secondary .widget_calendar table tfoot td a { 
	color: <?php echo $accent; ?>;
}

#secondary .widget_calendar table #today { 
	border: 3px solid <?php echo $accent; ?>;
}

#secondary .widget_calendar table a { 
	color: <?php echo $accent; ?>;
}

form.search-form .search-field {
	border-top: 1px solid <?php echo $accent; ?>;
	border-left: 1px solid <?php echo $accent; ?>;
	border-bottom: 1px solid <?php echo $accent; ?>;
}

form.search-form button {
	background: <?php echo $accent; ?>;
}

.de_modal .close {
    color: <?php echo $accent; ?>;
}

.de_modal .close:hover {
	background: <?php echo $accent; ?>;
}

#masthead .branding h1 a,
#masthead .main-navigation ul > li > a:not(:hover),
#masthead .menu-toggle:not(:hover) {
	opacity: <?php echo $opacity; ?>;
}

.jFiler-theme-default .jFiler-input-button {
	background: <?php echo $accent; ?>;
}

#cboxPrevious,
#cboxNext,
#cboxClose {
	background: <?php echo $accent; ?>;
}

/* hover accent color */
form.search-form:hover button {
	background: <?php echo $accenthov; ?>;
}

html input[type="button"]:hover, 
input[type="reset"]:hover, 
input[type="submit"]:hover,
.button:hover {
	background:  <?php echo $accenthov; ?>;
}

.profile-tabs .tabs-menu ul li.ui-tabs-active a,
.profile-tabs .tabs-menu ul li a:hover {
	background: <?php echo $accenthov; ?>;
}

.jFiler-theme-default .jFiler-input-button:hover {
	background: <?php echo $accenthov; ?>;
}

form.search-form:hover .search-field {
	border-top: 1px solid <?php echo $accenthov; ?>;
	border-left: 1px solid <?php echo $accenthov; ?>;
	border-bottom: 1px solid <?php echo $accenthov; ?>;
}

.user_menu li a:hover {
	background: <?php echo $accenthov; ?>;
}

.main-navigation ul.sub-menu li:hover, .main-navigation ul.children li:hover {
	background: <?php echo $accenthov; ?>;
}

.homepage-slider .owl-buttons .owl-prev:hover,
.homepage-slider .owl-buttons .owl-next:hover {
	background: <?php echo $accenthov; ?>;
}

#cboxPrevious:hover,
#cboxNext:hover,
#cboxClose:hover {
	background: <?php echo $accenthov; ?>;
}

/* footer colors */
footer .site-info {
	background: <?php echo $site_info; ?>;
	color: <?php echo $site_info_color; ?>;
}

#colophon {
	background: <?php echo $footer_color; ?>;
}