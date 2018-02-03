<?php 
/**
 * Theme functions
 *
 * @package Demure
 */


/**
 * Search heading
 */
if ( ! function_exists( 'demure_get_search_heading' ) ) {
	function demure_get_search_heading() {
		$search_result = get_search_query();
		?>
			<div class="search-section-heading"><h1><?php esc_html_e( 'Search result for', 'demure' ); ?>: <?php echo esc_html( $search_result ); ?></h1></div>
		<?php
	}
}

/**
 * Before content
 */
if ( ! function_exists( 'demure_before_content' ) ) {
	function demure_before_content() {
		global $post;
		echo '<div id="content" class="site-content container">';
	}
}

/**
 * Add inline custom styles
 */
function demure_add_custom_styles() {
	$styles_custom = ".page article, .page article header h3, .page .entry-content { padding: 0!important; }";
	wp_add_inline_style( 'demure-style', $styles_custom );	
}

/**
 * Check if blog page
 */
function is_blog() {
	global  $post;
	$posttype = get_post_type( $post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

/**
 * Get sidebar
 */
if ( ! function_exists( 'demure_get_sidebar' ) ) {
    function demure_get_sidebar( $order ) {
        if ( is_front_page() ) {
            dynamic_sidebar( 'main-' . $order );
        } elseif ( !is_single() && is_blog() ) {
            dynamic_sidebar( 'blog-' . $order );
        } elseif ( ( is_single() && is_blog() ) || ( !is_front_page() && is_page() ) ) {
            dynamic_sidebar( 'single-' . $order );
        }
    }
}

/**
 * Sidebar layout
 */
if ( ! function_exists( 'demure_get_sidebar_layout' ) ) {
    function demure_get_sidebar_layout( $main_layout, $order ) {
        switch ( $main_layout ) {
            case 1:
                ?>
                <aside class="sidebar widget-area col-lg-4 col-md-4 col-sm-4 col-xs-12" role="complementary"> 
                    <?php demure_get_sidebar( $order ); ?>
                </aside><!-- #secondary -->
                <?php
                break;
            case 2:
                ?>
                <aside class="sidebar widget-area col-lg-4 col-md-4 col-sm-4 col-xs-12" role="complementary"> 
                    <?php demure_get_sidebar( $order ); ?>
                </aside><!-- #secondary -->
                <?php
                break;
            case 3:
                ?>
                <aside class="sidebar widget-area col-lg-4 col-md-4 col-sm-4 col-xs-12" role="complementary"> 
                    <?php demure_get_sidebar( $order ); ?>
                </aside><!-- #secondary -->
                <?php
                break;
            case 4:
                ?>
                <aside class="sidebar widget-area col-lg-3 col-md-3 col-sm-3 col-xs-12" role="complementary"> 
                    <?php demure_get_sidebar( $order ); ?>
                </aside><!-- #secondary -->
                <?php
                break;
            case 5:
                ?>
                <aside class="sidebar widget-area col-lg-3 col-md-3 col-sm-3 col-xs-12" role="complementary"> 
                    <?php demure_get_sidebar( $order ); ?>
                </aside><!-- #secondary -->
                <?php
                break;
            case 6:
                ?>
                <aside class="sidebar widget-area col-lg-3 col-md-3 col-sm-3 col-xs-12" role="complementary"> 
                    <?php demure_get_sidebar( $order ); ?>
                </aside><!-- #secondary -->
                <?php
                break;
        }
    }
}

/**
 * Get Main Content
 */
if ( ! function_exists( 'demure_get_main_content' ) ) {
    function demure_get_main_content() {
        global $demure_config;
        $main_layout = 1;
		
		$page_layout_option = rwmb_meta( 'page_layout' );
        if ( class_exists( 'Redux' ) ) {
			if ( is_front_page() && !empty( $demure_config['main_layout'] ) ) $main_layout = $demure_config['main_layout'];
	
			if ( !is_single() && is_blog() && !empty( $demure_config['blog_layout'] ) ) $main_layout = $demure_config['blog_layout'];
			
			if ( is_single() && is_blog() && !empty( $demure_config['single_blog_layout'] ) ) $main_layout = $demure_config['single_blog_layout'];	
        } elseif ( ( $page_layout_option == 1 || empty( $page_layout_option ) ) && ! class_exists( 'Redux' ) ) {
        	if ( is_front_page() ) {
				if ( is_active_sidebar( 'main-primary' ) ) $main_layout = 3;
				if ( is_active_sidebar( 'main-secondary' ) ) $main_layout = 4;
        	} elseif ( !is_single() && is_blog() ) {
				if ( is_active_sidebar( 'blog-primary' ) ) $main_layout = 3;
				if ( is_active_sidebar( 'blog-secondary' ) ) $main_layout = 4;
			} elseif ( is_single() && is_blog() ) {
				if ( is_active_sidebar( 'single-primary' ) ) $main_layout = 3;
				if ( is_active_sidebar( 'single-secondary' ) ) $main_layout = 4;
			}
        }
		
		if ( ( isset( $page_layout_option ) && !empty( $page_layout_option ) && $page_layout_option != 1 ) && ( ( !is_single() && is_blog() ) || ( is_single() && is_blog() ) ) ) $main_layout = $page_layout_option;

        switch ( $main_layout ) {
            case 1:
                ?>
                <div id="primary" class="content-area col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <main id="main" class="site-main" role="main">
                         <?php demure_get_content(); ?>
                    </main>
                </div>
                <?php
                break;
            case 2:
                demure_get_sidebar_layout( $main_layout, 'primary' );
                ?>
                <div id="primary" class="content-area col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <main id="main" class="site-main" role="main">
                         <?php demure_get_content(); ?>
                    </main>
                </div>
                <?php
                break;
            case 3:
                ?>
                <div id="primary" class="content-area col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <main id="main" class="site-main" role="main">
                         <?php demure_get_content(); ?>
                    </main>
                </div>
                <?php
                demure_get_sidebar_layout( $main_layout, 'primary' );
                break;
            case 4:
                demure_get_sidebar_layout( $main_layout, 'primary' );
                ?>
                <div id="primary" class="content-area col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <main id="main" class="site-main" role="main">
                         <?php demure_get_content(); ?>
                    </main>
                </div>
                <?php
                demure_get_sidebar_layout( $main_layout, 'secondary' );
                break;
            case 5:
                demure_get_sidebar_layout( $main_layout, 'primary' );
                demure_get_sidebar_layout( $main_layout, 'secondary' );
                ?>
                <div id="primary" class="content-area col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <main id="main" class="site-main" role="main">
                         <?php demure_get_content(); ?>
                    </main>
                </div>
                <?php
                break;
            case 6:
                ?>
                <div id="primary" class="content-area col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <main id="main" class="site-main" role="main">
                         <?php demure_get_content(); ?>
                    </main>
                </div>
                <?php
                demure_get_sidebar_layout( $main_layout, 'primary' );
                demure_get_sidebar_layout( $main_layout, 'secondary' );
                break;
        }
    }
}

/**
 * Get Content
 */
if ( ! function_exists( 'demure_get_content' ) ) {
    function demure_get_content() {
        global $demure_config, $wp_query;
        if ( !class_exists( 'WooCommerce' ) && is_archive() ) {
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
        }

        if ( is_search() ) {
            demure_get_search_heading();
        }
		
		if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
			woocommerce_content();
			return;
		}

        if ( have_posts() ) :

            while ( have_posts() ) : the_post();

                if ( is_page() ) {
                    get_template_part( 'template-parts/content', 'page' );
                } elseif ( is_search() ) {
                    get_template_part( 'template-parts/content', 'search' );
                } else {
					get_template_part( 'template-parts/content', get_post_format() );
				}

            endwhile;
            
            if ( is_single() || is_page() && ( comments_open() || get_comments_number() ) ) :
                
                wp_link_pages( array(
    				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'demure' ) . '</span>',
    				'after'       => '</div>',
    				'link_before' => '<span>',
    				'link_after'  => '</span>',
    			) );

                comments_template();
                
            endif;

            if ( is_tag() || is_category() || is_archive() || is_front_page() || ( is_home() && !is_front_page() ) ):
                if ( $demure_config['post_navigation'] == '2' || $demure_config['post_navigation'] == '3' ) {
                    if (  $wp_query->max_num_pages > 1 ) : ?>
                        <script id="true_loadmore">
                        var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                        var true_posts = '<?php echo serialize( $wp_query->query_vars ); ?>';
                        var current_page = <?php echo ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; ?>;
                        var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
                        </script>
                        <?php if ( $demure_config['post_navigation'] == '2' ) { ?>
                            <div id="loadmore">
                                <span data-loading="<?php esc_html_e( 'Loading ...', 'demure' ); ?>" data-load-more="<?php esc_html_e( 'Load More', 'demure' ); ?>" class="button"><?php esc_html_e( 'Load More', 'demure' ); ?></span>
                            </div>
                        <?php } ?>
                    <?php endif;
                } else {
                    the_posts_pagination( array( 'screen_reader_text' => ' ' ) );
                }
                
            endif;

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
    }
}

/**
 * Site branding
 */
if ( ! function_exists( 'demure_branding' ) ) {
    function demure_branding() {
		if ( get_theme_mod( 'custom_logo' ) ) {
			the_custom_logo();
		}
		
		if ( get_theme_mod( 'header_text', 1 ) === 1 ) {
			echo '<div class="branding branding-text">';
				echo '<h1><a href="' . esc_url( home_url() ) . '">' . get_bloginfo('name') . '</a></h1>';
				echo '<span>' . get_bloginfo('description') . '</span>';
			echo '</div>';
		}
    }
}

/**
 * Post header
 */
if ( ! function_exists( 'demure_post_header' ) ) {
    function demure_post_header( $post_id = '' ) {
        global $post;
        $out_header = $page_title = $out = '';
        $page_title = rwmb_meta( 'page_title');
		
        if ( !is_single() && !is_page() ) {
            $out_header .= '<h3><a href="' . get_the_permalink( $post_id ) . '">' . get_the_title( $post_id ) . '</a></h3>';
        } else {
            $out_header .= '<h1>' . get_the_title( $post_id ) . '</h1>';
        }
		
		if ( isset( $page_title ) && $page_title == 'off' ) $out_header = '<div class="no-title-padding"></div>';
		
		$out = '<header class="entry-header">';
            $out .= $out_header;
        $out .= '</header><!-- .entry-header -->';
        
        echo $out;
    }
}

/**
 * Post Content
 */
if ( ! function_exists( 'demure_post_content' ) ) {
    function demure_post_content() {
        $content = get_the_content( get_the_ID() );
        if ( ( !is_front_page() && is_home() ) || ( is_home() ) || is_author() || is_search() ) {
            $content = wp_trim_words( get_the_content(), 55, '<a class="read_more" href="' . esc_url( get_permalink() ) . '">' . esc_html__('Read More', 'demure') . '</a>' );
        }
        
        $post_content = apply_filters( 'the_content', $content );
        
        $out = '<div class="entry-content">';
            $out .= $post_content;
            $out .= '<div class="clearfix"></div>';
        $out .= '</div><!-- .entry-content -->';
        
        echo $out;
    }
}

/**
 * Post Thumbail
 */
if ( ! function_exists( 'demure_post_thumbnail' ) ) {
    function demure_post_thumbnail() {
        global $post;
        if ( ! has_post_thumbnail( $post ) ) return false;

        if ( is_single() || is_page() ) {
			?>
            <div class="thumbnail thumbnail-single">
                <?php the_post_thumbnail(); ?>
                <div class="overlay"></div>
            </div>
			<?php
        } else {
			?>
            <a href="<?php the_permalink( $post->ID ); ?>" class="thumbnail">
                <?php the_post_thumbnail(); ?>
                <div class="overlay"></div>
            </a>
			<?php
        }
    }
}

/**
 * Post Meta
 */
if ( ! function_exists( 'demure_get_post_meta' ) ) {
	function demure_get_post_meta() {
		global $demure_config, $post;
		$out = '';
		$display_date = $display_author = 1;
		if ( isset( $demure_config ) ) {
			$display_date = $demure_config['display_date'];
			$display_author = $demure_config['display_author'];
		}

		if ( ( $display_author != 1 && $display_date != 1 ) || ( get_post_type() == 'page' && is_search() ) ) return false;
		$out .= '<div class="entry-meta">';
			if ( isset( $display_author ) && $display_author == 1 ) {
				$out .= '<div class="author">';
					$out .= '<span class="author_label"><i class="fa fa-user" aria-hidden="true"></i></span><a href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '"> ' . get_the_author() . '</a>';
				$out .= '</div>';
			}
			
			if ( isset( $display_date ) && $display_date == 1 ) {
				$out .= '<div class="date">';
					$out .= '<i class="fa fa-clock-o" aria-hidden="true"></i>' . get_the_date( null, $post->ID );
				$out .= '</div>';
			}
		$out .= '</div>';
		echo $out;
	}
}

/**
 * Post Footer
 */
if ( ! function_exists( 'demure_post_footer' ) ) {
    function demure_post_footer() {
        global $demure_config, $post;
		$display_categories = $display_tags = 1;
		
		if ( isset( $demure_config ) ) {
			$display_categories = $demure_config['display_categories'];
			$display_tags = $demure_config['display_tags'];
		}
		
        $out = '<footer class="entry-footer">';
            
                if ( isset( $display_categories ) && $display_categories == '1' ) {
                    $all_categories = get_the_category( $post->ID );
                    
                    if ( !empty( $all_categories ) ) {
                        $out .= '<div class="categories-list">';
                            foreach ( $all_categories as $key => $cat ) {
                                $out .= '<a href="' . get_term_link( $cat->term_id ) . '">' . esc_html( $cat->name ) . '</a>';
                            }
                        $out .= '</div>';
                    }    
                }
                
                if ( isset( $display_tags ) && $display_tags == '1' ) {
                    $all_tags = get_the_tags( $post->ID );
                    
                    if ( !empty( $all_tags ) ) {
                        $out .= '<div class="tag-list">';
                            foreach ( $all_tags as $key => $tag ) {
                                $out .= '<a href="' . get_term_link( $tag->term_id ) . '">' . esc_html( $tag->name ) . '</a>';
                            }
                        $out .= '</div>';
                    }    
                }
            
        $out .= '</footer><!-- .entry-footer -->';
        
        echo $out;
    }
}

/**
 * Filter for comment form fields
 */
add_filter('comment_form_fields', 'demure_reorder_comment_fields' );
if ( ! function_exists( 'demure_reorder_comment_fields' ) ) {
    function demure_reorder_comment_fields( $fields ){

        $new_fields = array();

        $demure_order = array('author','email','comment');

        foreach( $demure_order as $key ){
            $new_fields[ $key ] = $fields[ $key ];
            unset( $fields[ $key ] );
        }

        if( $fields )
            foreach( $fields as $key => $val )
                $new_fields[ $key ] = $val;

        unset( $new_fields['url'] );

        return $new_fields;
    }
}

/**
 * Ajax load posts
 */
function demure_ajax_load_posts(){
    $args = unserialize( stripslashes( $_POST['query'] ) );
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';
    $q = new WP_Query($args);
    if( $q->have_posts() ):
        while( $q->have_posts() ): $q->the_post();
            get_template_part( 'template-parts/content', get_post_format() );
        endwhile;
    endif;
    wp_reset_postdata();
    die();
}
add_action('wp_ajax_loadposts', 'demure_ajax_load_posts');
add_action('wp_ajax_nopriv_loadposts', 'demure_ajax_load_posts');

/**
 * Homepage slider
 */
if ( ! function_exists( 'demure_get_homepage_slider' ) ) {
    function demure_get_homepage_slider(){
        global $demure_config;
        if ( ( !empty( $demure_config['switch_slider'] ) && $demure_config['switch_slider']  == '1' ) && ( !is_home() && is_front_page() ) ) {

            $slides = $demure_config['home_slider'];
            ?>
            <div class="homepage-slider-wrapper">
                <div class="homepage-slider owl-carousel">
                    <?php foreach ($slides as $key => $slide): ?>
                        <div class="slide">
                            <?php if ( !empty( $slide['title'] ) || !empty( $slide['description'] ) ): ?>
                                <div class="slide-information">
                                    <?php if ( !empty( $slide['title'] ) ): ?>
                                        <h3><?php echo esc_html( $slide['title'] ); ?></h3>
                                    <?php endif ?>
                                    <?php if ( !empty( $slide['description'] ) ): ?>
                                        <div class="description"><?php echo esc_textarea( $slide['description'] ); ?></div>
                                    <?php endif ?>   
                                </div>
                               
                                
                            <?php endif ?>
                            
                            
                            <img data-src="holder.js/1980x1080?text=image" src="<?php echo esc_url( $slide['image'] ); ?>" alt="">
                            <?php if ( !empty( $slide['url'] ) ): ?>
                                <a class="slide_link" href="<?php echo esc_url( $slide['url'] ); ?>"></a>
                            <?php endif ?>
                            <div class="overlay"></div>
                        </div>
                    <?php endforeach ?>
                </div>    
            </div>
            <?php
        }
    }
}

/**
 * Loop user posts
 */
if ( ! function_exists( 'demure_get_all_user_posts' ) ) {
    function demure_get_all_user_posts() {
        global $demure_config;
        wp_reset_postdata();
        if ( have_posts() ) {
            
            ?>
            <h3 class="heading"><?php printf( 'Posts by %s', get_the_author() ); ?></h3>
            <?php

            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', get_post_format() );
            endwhile;

            if ( $demure_config['post_navigation'] == '2' || $demure_config['post_navigation'] == '3' ) {
                global $wp_query;
                if (  $wp_query->max_num_pages > 1 ) : ?>
                    <script id="true_loadmore">
                    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                    var true_posts = '<?php echo serialize( $wp_query->query_vars ); ?>';
                    var current_page = <?php echo ( get_query_var('paged') ) ? get_query_var('paged') : 1; ?>;
                    var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
                    </script>
                    <?php if ( $demure_config['post_navigation'] == '2' ) { ?>
                        <div id="loadmore">
                            <span data-loading="<?php esc_html_e( 'Loading ...', 'demure' ); ?>" data-load-more="<?php esc_html_e( 'Load More', 'demure' ); ?>" class="button"><?php esc_html_e( 'Load More', 'demure' ); ?></span>
                        </div>
                    <?php } ?>
                <?php endif;
            } elseif ( $demure_config['post_navigation'] == '1' ) {
                the_posts_pagination( array( 'screen_reader_text' => ' ' ) );
            }

        } else {

            get_template_part( 'template-parts/content', 'none' );

        }
    }
}

/**
 * Preloader
 */
if ( ! function_exists( 'demure_preloader' ) ) {
    function demure_preloader() {
        global $demure_config;
        if ( !empty($demure_config['preloader']) && $demure_config['preloader'] == '1' ) {
            $out = '<div class="demure-preloader"><div class="uil-cube-css" style="-webkit-transform:scale(0.6)"><div></div><div></div><div></div><div></div></div></div>';
            echo $out;
        }
    }
}

/**
 * Footer text
 */
if ( ! function_exists( 'demure_footer_text' ) ) {
    function demure_footer_text() {
        global $demure_config;
        if ( empty( $demure_config['footer-text'] ) ) return false;
        $out = '';
        $allowed_tags = wp_kses_allowed_html( 'post' );
		$out .= '<div class="site-info-text">';
        	$out .= wp_kses( stripslashes( $demure_config['footer-text'] ), $allowed_tags );
		$out .= '</div>';
        echo $out;
    }
}

/**
 * Get comment
 */
if ( ! function_exists( 'demure_get_comment' ) ) {
	function demure_get_comment( $comment, $args, $depth ) {
		if ( !empty( $comment ) ) {
			global $post;
			
			$out = '';
			$id_ = $comment->comment_ID;
			$author = get_comment_author_link( $id_ );
			$comment_class = get_comment_class( 'comment-class', $id_ );
			$date_format = get_option('date_format');
			$date = get_comment_date( $date_format, $id_ );
			$args_reply = array( 'reply_text' => esc_html__( 'Reply to %s', 'demure' ) );
			$comment_content = apply_filters( 'comment_text', $comment->comment_content );
			$out .= '<div class="' . implode(' ', $comment_class ) . '">';
				$out .= '<div class="comment-wrap">';
					$out .= '<div class="comment-author-block">';
						$out .= '<div class="comment-author-avatar">'. get_avatar( $comment->user_id ) . '</div>';
					$out .= '</div>';
					$out .= '<div class="comment-content-block">';
						$out .= '<div class="comment-header">';
								$out .= '<div class="comment-author">' . $author . '</div>';
							$out .= '<div class="date">' . esc_html( $date ) . '</div>';
						$out .= '</div>';
						$out .= '<div class="comment">' . $comment_content . '</div>';
						$out .= '<div class="comment-footer">' . get_comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => esc_html__('Reply', 'demure') ) ) ) . '</div>';

					$out .= '</div>';
				$out .= '</div>';
			
			echo $out;
		}
		
	}
}

/**
 * Get footer columns
 */
if ( ! function_exists( 'demure_get_footer_columns' ) ) {
	function demure_get_footer_columns() {
		global $demure_config;
		$columns = 4;
		if ( ! empty( $demure_config['footer-columns'] ) ) $columns = $demure_config['footer-columns'];
		if ( !is_active_sidebar( 'footer-first' ) && !is_active_sidebar( 'footer-second' ) && !is_active_sidebar( 'footer-third' ) && !is_active_sidebar( 'footer-fourth' ) && !is_active_sidebar( 'footer-fifth' ) && !is_active_sidebar( 'footer-sixth' ) ) return false; 
		?>
		<div class="footer-wrap">
		<div class="row">
		<?php
		
		switch ( $columns ) {
			case 1:
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php dynamic_sidebar( 'footer-first' ); ?>
				</div>
				<?php
				break;
			case 2:
				?>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<?php dynamic_sidebar( 'footer-first' ); ?>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<?php dynamic_sidebar( 'footer-second' ); ?>
				</div>
				<?php
				break;
			case 3:
				?>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<?php dynamic_sidebar( 'footer-first' ); ?>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<?php dynamic_sidebar( 'footer-second' ); ?>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<?php dynamic_sidebar( 'footer-third' ); ?>
				</div>
				<?php
				break;
			case 4:
				?>
				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<?php dynamic_sidebar( 'footer-first' ); ?>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<?php dynamic_sidebar( 'footer-second' ); ?>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<?php dynamic_sidebar( 'footer-third' ); ?>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<?php dynamic_sidebar( 'footer-fourth' ); ?>
				</div>
				<?php
				break;
			case 6:
				?>
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
					<?php dynamic_sidebar( 'footer-first' ); ?>
				</div>
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
					<?php dynamic_sidebar( 'footer-second' ); ?>
				</div>
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
					<?php dynamic_sidebar( 'footer-third' ); ?>
				</div>
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
					<?php dynamic_sidebar( 'footer-fourth' ); ?>
				</div>
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
					<?php dynamic_sidebar( 'footer-fifth' ); ?>
				</div>
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
					<?php dynamic_sidebar( 'footer-sixth' ); ?>
				</div>
				<?php
				break;
		}
		?></div></div><?php
	}
}

/**
 * Social buttons
 */
if ( ! function_exists( 'demure_get_social' ) ) {
	function demure_get_social() {
		global $demure_config;
		$out = '';
		$out .= '<div class="social-links-wrapper">';
			if ( !empty( $demure_config['facebook'] ) ) $out .= '<a href="'.esc_url( $demure_config['facebook'] ).'" target="_blank" class="demure-icon"><i class="fa fa-facebook"></i></a>';
			if ( !empty( $demure_config['twitter'] ) ) $out .= '<a href="'.esc_url( $demure_config['twitter'] ).'" target="_blank" class="demure-icon"><i class="fa fa-twitter"></i></a>';
			if ( !empty( $demure_config['vkontakte'] ) ) $out .= '<a href="'.esc_url( $demure_config['vkontakte'] ).'" target="_blank" class="demure-icon"><i class="fa fa-vk"></i></a>';
			if ( !empty( $demure_config['linkedin'] ) ) $out .= '<a href="'.esc_url( $demure_config['linkedin'] ).'" target="_blank" class="demure-icon"><i class="fa fa-linkedin"></i></a>';
			if ( !empty( $demure_config['pinterest'] ) ) $out .= '<a href="'.esc_url( $demure_config['pinterest'] ).'" target="_blank" class="demure-icon"><i class="fa fa-pinterest"></i></a>';
			if ( !empty( $demure_config['youtube'] ) ) $out .= '<a href="'.esc_url( $demure_config['youtube'] ).'" target="_blank" class="demure-icon"><i class="fa fa-youtube"></i></a>';
			if ( !empty( $demure_config['instagram'] ) ) $out .= '<a href="'.esc_url( $demure_config['instagram'] ).'" target="_blank" class="demure-icon"><i class="fa fa-instagram"></i></a>';
			if ( !empty( $demure_config['googleplus'] ) ) $out .= '<a href="'.esc_url( $demure_config['googleplus'] ).'" target="_blank" class="demure-icon"><i class="fa fa-google-plus"></i></a>';
			if ( !empty( $demure_config['behance'] ) ) $out .= '<a href="'.esc_url( $demure_config['behance'] ).'" target="_blank" class="demure-icon"><i class="fa fa-behance"></i></a>';
			if ( !empty( $demure_config['flickr'] ) ) $out .= '<a href="'.esc_url( $demure_config['flickr'] ).'" target="_blank" class="demure-icon"><i class="fa fa-flickr"></i></a>';
			if ( !empty( $demure_config['skype'] ) ) $out .= '<a href="call:'.sanitize_text_field( $demure_config['skype'] ).'" target="_blank" class="demure-icon"><i class="fa fa-skype"></i></a>';
			if ( !empty( $demure_config['dribble'] ) ) $out .= '<a href="'.esc_url( $demure_config['dribble'] ).'" target="_blank" class="demure-icon"><i class="fa fa-dribble"></i></a>';
			if ( !empty( $demure_config['email'] ) ) $out .= '<a href="mailto:'.sanitize_email( $demure_config['email'] ).'" target="_blank" class="demure-icon"><i class="fa fa-facebook"></i></a>';
		$out .= '</div>';
		
		echo $out;
	}
}

/**
 * Check if footer has footer text or social
 */
if ( ! function_exists( 'demure_footer_has_text_and_social' ) ) {
	function demure_footer_has_text_and_social() {
		if ( ( 
		!empty( $demure_config['facebook'] ) || 
		!empty( $demure_config['twitter'] ) || 
		!empty( $demure_config['vkontakte'] ) || 
		!empty( $demure_config['linkedin'] ) || 
		!empty( $demure_config['pinterest'] ) || 
		!empty( $demure_config['youtube'] ) || 
		!empty( $demure_config['instagram'] ) || 
		!empty( $demure_config['googleplus'] ) || 
		!empty( $demure_config['behance'] ) || 
		!empty( $demure_config['flickr'] ) || 
		!empty( $demure_config['skype'] ) || 
		!empty( $demure_config['dribble'] ) || 
		!empty( $demure_config['email'] ) ) || ( !empty( $demure_config['footer-text'] ) ) ) {
			return true;
		}
	}
}

/**
 * Replace gallery shortcode
 */
function demure_gallery_shortcode( $output = '', $atts, $instance ) {
	global $post;
	$pid = $post->ID;
	$gallery = $out = "";

	if ( empty( $pid ) ) { 
        $pid = (int)$post['ID'];
    }

	if (!empty( $atts['ids'] ) ) {
	   	$atts['orderby'] = 'post__in';
	   	$atts['include'] = $atts['ids'];
	}
    

	extract( shortcode_atts( array(
        'orderby' => 'menu_order ASC, ID ASC', 
        'include' => '', 
        'id' => $pid, 
        'itemtag' => 'dl', 
        'icontag' => 'dt', 
        'captiontag' => 'dd', 
        'columns' => 3, 
        'size' => 'large', 
        'link' => 'file'
    ), $atts, 'gallery' ) );

	$args = array(
        'post_type' => 'attachment', 
        'post_status' => 'inherit', 
        'post_mime_type' => 'image', 
        'orderby' => $orderby
    );

	if ( !empty($include ) ) {
        $args['include'] = $include;
    } else {
	   	$args['post_parent'] = $id;
		$args['numberposts'] = -1;
	}

	if ( $args['include'] == "" ) { 
        $args['orderby'] = 'date'; 
        $args['order'] = 'asc';
    }

	$images = get_posts( $args );
    
    $unic_id = uniqid('gallery_');
    
    $out .= '<div id="' . esc_attr( $unic_id ) . '" class="gallery gallery-columns-' . esc_attr( $columns ) . ' size-' . esc_attr( $size ) . '">';
    
    if ( !empty($images) ) {
        foreach ( $images as $image ) {
    		
    		$thumbnail = wp_get_attachment_image_src( $image->ID, $size );
    		$thumbnail = $thumbnail[0];
            
            $full_image = wp_get_attachment_image_src( $image->ID, 'full' );
            $full_image = $full_image[0];
            
            $out .= '<a href="' . esc_url( $full_image ) . '" class="gallery-item" rel="group_' . esc_attr( $unic_id ).'">';
                $out .= '<figure>';
                $out .= '<img src="' . esc_url( $thumbnail ) . '" />';
                    $out .= '<figcaption class="gallery-caption">';
                        $out .= '<div class="img-title">' . esc_html( $image->post_title ) . '</div>';
                        $out .= '<div class="img-caption">' . esc_html( $image->post_excerpt ) . '</div>';
                    $out .= '</figcaption>';
                $out .= '</figure>';
            $out .= '</a>';
    	}
    }
	
    $out .= '</div>';
	
	return $out;
}
add_filter( 'post_gallery', 'demure_gallery_shortcode', 10, 3 );
