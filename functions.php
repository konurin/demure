<?php
/**
 * demure functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package demure
 */

if ( ! function_exists( 'demure_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function demure_setup() {
	
	/*
	*	Add image sizes
	*/
	add_image_size( 'demure-popular-widget-thumb', 100, 80, true );
	
	/*
	* Content width
	*/
	if ( ! isset( $content_width ) ) $content_width = 1140;
	
	/*
	* Theme options
	*/
	require_once locate_template(  'inc/admin/demure-config.php', true, true ); 
	
	/*
	* Metaboxes
	*/
	require_once locate_template(  'inc/admin/metaboxes/meta-box.php', true, true ); 
	require_once locate_template(  'inc/admin/metaboxes.php', true, true ); 

	/*
	* Theme functions
	*/
	require_once locate_template(  'inc/theme/theme-functions.php', true, true );
	
	/*
	* Theme widgets
	*/
	require_once locate_template(  'inc/widgets/popular-widget.php', true, true );
	require_once locate_template(  'inc/widgets/load.php', true, true );
	
	/*
	* TGM
	*/
	require_once get_template_directory() . '/inc/admin/TGM/init.php';
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on demure, use a find and replace
	 * to change 'demure' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'demure', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	// Add woocommerce support 
	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'post-formats', array( 'image', 'gallery' ) );

	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 150,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	register_nav_menu( 'primary', 'Primary Menu' );
	register_nav_menu( 'secondary', 'Secondary Menu' );
	
}
endif;
add_action( 'after_setup_theme', 'demure_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function demure_widgets_init() {
	// main widgets
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar (primary)', 'demure' ),
		'id'            => 'main-primary',
		'description'   => esc_html__( 'Displayed on the main page (first sidebar)', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar (secondary)', 'demure' ),
		'id'            => 'main-secondary',
		'description'   => esc_html__( 'Displayed on the main page (second sidebar)', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar (primary)', 'demure' ),
		'id'            => 'blog-primary',
		'description'   => esc_html__( 'Displayed on the blog page (first sidebar)', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar (secondary)', 'demure' ),
		'id'            => 'blog-secondary',
		'description'   => esc_html__( 'Displayed on the blog page (second sidebar)', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Single Sidebar (primary)', 'demure' ),
		'id'            => 'single-primary',
		'description'   => esc_html__( 'Displayed on the post pages (first sidebar)', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Single Sidebar (secondary)', 'demure' ),
		'id'            => 'single-secondary',
		'description'   => esc_html__( 'Displayed on the post pages (second sidebar)', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	// footer widgets
	register_sidebar( array(
		'name'          => esc_html__( 'First column', 'demure' ),
		'id'            => 'footer-first',
		'description'   => esc_html__( 'Displayed on the footer (First column)', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Second column', 'demure' ),
		'id'            => 'footer-second',
		'description'   => esc_html__( 'Displayed on the footer (Second column)', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Third column', 'demure' ),
		'id'            => 'footer-third',
		'description'   => esc_html__( 'Displayed on the footer (Third column)', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) ); 
	
	register_sidebar( array(
		'name'          => esc_html__( 'Fourth column', 'demure' ),
		'id'            => 'footer-fourth',
		'description'   => esc_html__( 'Displayed on the footer (Fourth column)', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) ); 
	
	register_sidebar( array(
		'name'          => esc_html__( 'Fifth column', 'demure' ),
		'id'            => 'footer-fifth',
		'description'   => esc_html__( 'Displayed on the footer (Fifth column)', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) ); 
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sixth column', 'demure' ),
		'id'            => 'footer-sixth',
		'description'   => esc_html__( 'Displayed on the footer (Sixth column)', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) ); 
	
	 
}
add_action( 'widgets_init', 'demure_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function demure_scripts() {
	global $demure_config;

	// magnific popup
	wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/inc/theme/assets/js/jquery.colorbox-min.js', array('jquery'), false, true );

	// holder 
	wp_enqueue_script( 'holder', get_template_directory_uri() . '/inc/theme/assets/js/holder.min.js', array('jquery'), false, true );

	// owl carousel
	if ( ( isset( $demure_config['home_slider'] ) && !empty( $demure_config['home_slider'] ) ) && is_front_page() && !is_home() ) {
		wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/inc/theme/assets/js/owl.carousel.min.js', array('jquery'), false, true );
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/inc/theme/assets/css/owl.carousel.css' );
		wp_enqueue_style( 'owl-transitions', get_template_directory_uri() . '/inc/theme/assets/css/owl.transitions.css' );
	}
	
	// smooth-scroll
	wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/inc/theme/assets/js/smooth-scroll.min.js', array( 'jquery' ), false, true );
	
	// comments reply
	if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// main script
	wp_enqueue_script( 'demure-main', get_template_directory_uri() . '/inc/theme/assets/js/demure-main.js', array('jquery'), false, true );
	
	// ajax settings
	$blog_nav = 1;
	if ( !empty( $demure_config['post_navigation'] ) ) {
		$blog_nav =  $demure_config['post_navigation'];
	}
	
	wp_localize_script( 'demure-main', 'DemureGlobal',
            array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),
				   'blognav'  => $blog_nav
			 ) );
			 
	wp_enqueue_script( 'selectize', get_template_directory_uri() . '/inc/theme/assets/js/selectize.min.js', array( 'jquery' ), false, true );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/inc/theme/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/theme/assets/css/fonts/font-awesome.min.css' );
	wp_enqueue_style( 'colorbox', get_template_directory_uri() . '/inc/theme/assets/css/colorbox.css' );
	wp_enqueue_style( 'selectize', get_template_directory_uri() . '/inc/theme/assets/css/selectize.css' );


	wp_enqueue_style( 'demure-style', get_stylesheet_uri() );
	
	// load woocommerce styles
	if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
		wp_enqueue_style( 'demure-woocommerce', get_template_directory_uri() . '/inc/theme/assets/css/demure-woocommerce.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'demure_scripts' );
add_action( 'wp_enqueue_scripts', 'demure_include_dynamic_css' );
function demure_include_dynamic_css() {
	wp_enqueue_style( 'demure-dynamic', admin_url('admin-ajax.php').'?action=demure_dynamic_css' );
}

add_action('wp_ajax_demure_dynamic_css', 'demure_dynamic_css');
add_action('wp_ajax_nopriv_demure_dynamic_css', 'demure_dynamic_css');
function demure_dynamic_css() {
	require( get_template_directory().'/inc/theme/dynamic-styles.php' );
	exit;
}

function addAndOverridePanelCSS() {
  wp_deregister_style( 'redux-admin-css' );
  wp_register_style(
    'demure-redux',
    get_template_directory_uri() . '/inc/admin/css/redux.css'
  );    
  wp_enqueue_style('demure-redux');
}
add_action( 'redux/page/demure_config/enqueue', 'addAndOverridePanelCSS' );

function demure_add_metaboxes_css() {
	wp_enqueue_style( 'demure-metaboxes', get_template_directory_uri() . '/inc/admin/css/metaboxes.css' );
}
add_action( 'admin_enqueue_scripts', 'demure_add_metaboxes_css' );