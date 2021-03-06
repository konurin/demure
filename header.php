<?php
/**
 * The header for demure theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package demure
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php demure_preloader(); ?>
<div id="page" class="site">

	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="wrapper">
				<div class="top-container">
					<?php demure_branding(); ?>
				</div>
				
				<div class="header-container">
					<div class="menu-right-block">
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
						</nav><!-- #site-navigation -->
						<div class="menu-toggle">
							<span class="line"></span>
							<span class="line"></span>
							<span class="line"></span>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</header><!-- #masthead -->

	<?php demure_get_homepage_slider(); ?>
	
	<?php demure_before_content(); ?>
		<div class="row">
