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
	* Template tags
	*/
	require_once locate_template(  'inc/theme/template-tags.php', true, true ); 
	
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

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
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
		'description'   => esc_html__( 'Add widgets here.', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar (secondary)', 'demure' ),
		'id'            => 'main-secondary',
		'description'   => esc_html__( 'Add widgets here.', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar (primary)', 'demure' ),
		'id'            => 'blog-primary',
		'description'   => esc_html__( 'Add widgets here.', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar (secondary)', 'demure' ),
		'id'            => 'blog-secondary',
		'description'   => esc_html__( 'Add widgets here.', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Single Sidebar (primary)', 'demure' ),
		'id'            => 'single-primary',
		'description'   => esc_html__( 'Add widgets here.', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Single Sidebar (secondary)', 'demure' ),
		'id'            => 'single-secondary',
		'description'   => esc_html__( 'Add widgets here.', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	// footer widgets
	register_sidebar( array(
		'name'          => esc_html__( 'First column', 'demure' ),
		'id'            => 'footer-first',
		'description'   => esc_html__( 'Add widgets here.', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Second column', 'demure' ),
		'id'            => 'footer-second',
		'description'   => esc_html__( 'Add widgets here.', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Third column', 'demure' ),
		'id'            => 'footer-third',
		'description'   => esc_html__( 'Add widgets here.', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) ); 
	
	register_sidebar( array(
		'name'          => esc_html__( 'Fourth column', 'demure' ),
		'id'            => 'footer-fourth',
		'description'   => esc_html__( 'Add widgets here.', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) ); 
	
	register_sidebar( array(
		'name'          => esc_html__( 'Fifth column', 'demure' ),
		'id'            => 'footer-fifth',
		'description'   => esc_html__( 'Add widgets here.', 'demure' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) ); 
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sixth column', 'demure' ),
		'id'            => 'footer-sixth',
		'description'   => esc_html__( 'Add widgets here.', 'demure' ),
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
	global $demure;

	// magnific popup
	wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/inc/theme/assets/js/jquery.colorbox-min.js', array('jquery'), false, true );

	// holder 
	wp_enqueue_script( 'holder', get_template_directory_uri() . '/inc/theme/assets/js/holder.min.js', array('jquery'), false, true );

	// owl carousel
	if ( ( isset( $demure['home_slider'] ) && !empty( $demure['home_slider'] ) ) && is_front_page() && !is_home() ) {
		wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/inc/theme/assets/js/owl.carousel.min.js', array('jquery'), false, true );
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/inc/theme/assets/css/owl.carousel.css' );
		wp_enqueue_style( 'owl-transitions', get_template_directory_uri() . '/inc/theme/assets/css/owl.transitions.css' );

	}
	
	// comments reply
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	
	// profile page tabs
	if ( is_author() ) {
		wp_enqueue_script( 'jquery-ui-tabs' );
	}
	
	// main script
	wp_enqueue_script( 'main', get_template_directory_uri() . '/inc/theme/assets/js/main.js', array('jquery'), false, true );
	
	// ajax settings
	$blog_nav = 1;
	if ( !empty( $demure['post_navigation'] ) ) {
		$blog_nav =  $demure['post_navigation'];
	}
	
	wp_localize_script( 'main', 'DemureGlobal',
            array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),
				   'blognav'  => $blog_nav
			 ) );

	wp_enqueue_style( 'demure-bootstrap', get_template_directory_uri() . '/inc/theme/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'demure-font-awesome', get_template_directory_uri() . '/inc/theme/assets/css/fonts/font-awesome.min.css' );
	wp_enqueue_style( 'colorbox', get_template_directory_uri() . '/inc/theme/assets/css/colorbox.css' );


	wp_enqueue_style( 'demure-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'demure_scripts' );

add_action( 'wp_enqueue_scripts', 'include_dynamic_css', 11 );
function include_dynamic_css() {
	wp_enqueue_style( 'dynamic-css', admin_url('admin-ajax.php').'?action=dynamic_css' );
}

add_action('wp_ajax_dynamic_css', 'dynamic_css');
add_action('wp_ajax_nopriv_dynamic_css', 'dynamic_css');
function dynamic_css() {
	require( get_template_directory().'/inc/theme/assets/style.css.php' );
	exit;
}

function addAndOverridePanelCSS() {
  wp_dequeue_style( 'redux-admin-css' );
  wp_register_style(
    'redux-demure-css',
    get_template_directory_uri() . '/inc/admin/css/redux.css',
    array( 'farbtastic' ) // Notice redux-admin-css is removed and the wordpress standard farbtastic is included instead
  );    
  wp_enqueue_style('redux-demure-css');
}
add_action( 'redux/page/demure/enqueue', 'addAndOverridePanelCSS' );

function add_metaboxes_css() {
	wp_enqueue_style( 'demure-metaboxes', get_template_directory_uri() . '/inc/admin/css/metaboxes.css' );
}
add_action( 'admin_enqueue_scripts', 'add_metaboxes_css' );