<?php 

if ( ! function_exists( 'get_demure_header_buttons' ) ) {
	function get_demure_header_buttons() {
		if ( !is_user_logged_in() ) {
			?>
			<div class="profile-navigation">
				<a class="open-modal" name="login-form" href="#"><?php esc_html_e( 'Sign In', 'demure' ); ?></a>
				<a class="open-modal" name="register-form" href="#"><?php esc_html_e( 'Register', 'demure' ); ?></a>
			</div>
			<?php
		} else {
			$user_id = get_current_user_id();
			$user_avatar = get_user_meta( $user_id, 'demure_avatar', true );
			
			if ( empty( $user_avatar ) ) {
				$user_avatar = get_avatar_url( $user_id, array( 'size' => 228 ) );
			}
			
			?>
			<div class="profile-navigation">
				<a href="<?php echo get_author_posts_url( $user_id ); ?>"><?php esc_html_e( 'My profile', 'demure' ); ?></a>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'demure_before_content' ) ) {
	function demure_before_content() {
		global $post;
		$style = $transparent_bg = '';
		$margin_top = rwmb_meta( 'margin_top', null, $post->ID );
		$margin_bottom = rwmb_meta( 'margin_bottom', null, $post->ID );
		$full_width = rwmb_meta( 'full_width', null, $post->ID );
		$transparent_bg = rwmb_meta( 'container_transparent', null, $post->ID );
		if ( $margin_top != '' ) {
			$margin_top = 'margin-top:' . $margin_top . 'px;';
		}
		
		if ( $margin_bottom != '' ) {
			$margin_bottom = 'margin-bottom:' . $margin_bottom . 'px;';
		}
		
		if ( $margin_top != '' || $margin_bottom != '' ) {
			$style = 'style="' . $margin_top . $margin_bottom . '"';
		}
		
		if ( $full_width == 'on' ) {
			$layout = 'container-fluid';
		} else {
			$layout = 'container';
		}
		
		if ( ! empty( $transparent_bg ) ) {
			$transparent_bg = 'transparent-container';
		}
		
		echo '<div id="content" ' . $style . ' class="site-content '.$layout.' '.$transparent_bg.'">';
	}
}

function is_blog() {
	global  $post;
	$posttype = get_post_type( $post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

if ( ! function_exists( 'get_demure_sidebar' ) ) {
    function get_demure_sidebar( $order ) {
        if ( is_front_page() ) {
            dynamic_sidebar( 'main-' . $order );
        } elseif ( !is_single() && is_blog() ) {
            dynamic_sidebar( 'blog-' . $order );
        } elseif ( ( is_single() && is_blog() ) || ( !is_front_page() && is_page() ) ) {
            dynamic_sidebar( 'single-' . $order );
        }
    }
}

if ( ! function_exists( 'get_demure_sidebar_layout' ) ) {
    function get_demure_sidebar_layout( $main_layout, $order ) {
        switch ( $main_layout ) {
            case 1:
                ?>
                <aside class="sidebar widget-area col-lg-4 col-md-4 col-sm-4 col-xs-12" role="complementary"> 
                    <?php get_demure_sidebar( $order ); ?>
                </aside><!-- #secondary -->
                <?php
                break;
            case 2:
                ?>
                <aside class="sidebar widget-area col-lg-4 col-md-4 col-sm-4 col-xs-12" role="complementary"> 
                    <?php get_demure_sidebar( $order ); ?>
                </aside><!-- #secondary -->
                <?php
                break;
            case 3:
                ?>
                <aside class="sidebar widget-area col-lg-4 col-md-4 col-sm-4 col-xs-12" role="complementary"> 
                    <?php get_demure_sidebar( $order ); ?>
                </aside><!-- #secondary -->
                <?php
                break;
            case 4:
                ?>
                <aside class="sidebar widget-area col-lg-3 col-md-3 col-sm-3 col-xs-12" role="complementary"> 
                    <?php get_demure_sidebar( $order ); ?>
                </aside><!-- #secondary -->
                <?php
                break;
            case 5:
                ?>
                <aside class="sidebar widget-area col-lg-3 col-md-3 col-sm-3 col-xs-12" role="complementary"> 
                    <?php get_demure_sidebar( $order ); ?>
                </aside><!-- #secondary -->
                <?php
                break;
            case 6:
                ?>
                <aside class="sidebar widget-area col-lg-3 col-md-3 col-sm-3 col-xs-12" role="complementary"> 
                    <?php get_demure_sidebar( $order ); ?>
                </aside><!-- #secondary -->
                <?php
                break;
        }
    }
}

if ( ! function_exists( 'get_main_content' ) ) {
    function get_main_content() {
        global $demure;
        $main_layout = 1;
		
		$page_layout_option = rwmb_meta( 'page_layout' );
        
        if ( is_front_page() && !empty( $demure['main_layout'] ) ) $main_layout = $demure['main_layout'];

        if ( !is_single() && is_blog() && !empty( $demure['blog_layout'] ) ) $main_layout = $demure['blog_layout'];
        
        if ( is_single() && is_blog() && !empty( $demure['single_blog_layout'] ) ) $main_layout = $demure['single_blog_layout'];
        
        if ( ( isset( $page_layout_option ) && !empty( $page_layout_option ) ) && ( ( !is_single() && is_blog() ) || ( is_single() && is_blog() ) || ( !is_front_page() ) ) ) $main_layout = $page_layout_option;

        switch ( $main_layout ) {
            case 1:
                ?>
                <div id="primary" class="content-area col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <main id="main" class="site-main" role="main">
                         <?php get_demure_content(); ?>
                    </main>
                </div>
                <?php
                break;
            case 2:
                get_demure_sidebar_layout( $main_layout, 'primary' );
                ?>
                <div id="primary" class="content-area col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <main id="main" class="site-main" role="main">
                         <?php get_demure_content(); ?>
                    </main>
                </div>
                <?php
                break;
            case 3:
                ?>
                <div id="primary" class="content-area col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <main id="main" class="site-main" role="main">
                         <?php get_demure_content(); ?>
                    </main>
                </div>
                <?php
                get_demure_sidebar_layout( $main_layout, 'primary' );
                break;
            case 4:
                get_demure_sidebar_layout( $main_layout, 'primary' );
                ?>
                <div id="primary" class="content-area col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <main id="main" class="site-main" role="main">
                         <?php get_demure_content(); ?>
                    </main>
                </div>
                <?php
                get_demure_sidebar_layout( $main_layout, 'secondary' );
                break;
            case 5:
                get_demure_sidebar_layout( $main_layout, 'primary' );
                get_demure_sidebar_layout( $main_layout, 'secondary' );
                ?>
                <div id="primary" class="content-area col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <main id="main" class="site-main" role="main">
                         <?php get_demure_content(); ?>
                    </main>
                </div>
                <?php
                break;
            case 6:
                ?>
                <div id="primary" class="content-area col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <main id="main" class="site-main" role="main">
                         <?php get_demure_content(); ?>
                    </main>
                </div>
                <?php
                get_demure_sidebar_layout( $main_layout, 'primary' );
                get_demure_sidebar_layout( $main_layout, 'secondary' );
                break;
        }
    }
}

if ( ! function_exists( 'get_demure_content' ) ) {
    function get_demure_content() {
        global $demure, $wp_query;
        if ( is_archive() ) {
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
        }

        if ( is_search() ) {
            get_demure_search_heading();
        }

        if ( have_posts() ) :

            while ( have_posts() ) : the_post();

                if (is_page()) {
                    get_template_part( 'template-parts/content', 'page' );
                } else{
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
                if ( $demure['post_navigation'] == '2' || $demure['post_navigation'] == '3' ) {
                    if (  $wp_query->max_num_pages > 1 ) : ?>
                        <script id="true_loadmore">
                        var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                        var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
                        var current_page = <?php echo ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; ?>;
                        var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
                        </script>
                        <?php if ( $demure['post_navigation'] == '2' ) { ?>
                            <div id="loadmore">
                                <span data-loading="<?php esc_html_e( 'Loading ...', 'demure' ); ?>" data-load-more="<?php esc_html_e( 'Load More', 'demure' ); ?>" class="button"><?php esc_html_e( 'Load More', 'demure' ); ?></span>
                            </div>
                        <?php } ?>
                    <?php endif;
                } elseif ( $demure['post_navigation'] == '1' ) {
                    the_posts_pagination( array( 'screen_reader_text' => ' ' ) );
                }
                
            endif;

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
    }
}

// get header 
if ( ! function_exists( 'get_demure_branding' ) ) {
    function get_demure_branding() {
        global $demure;
        $out = $type = $site_branding = $site_description = '';
        $type = $demure['header_logo_type'];
    
        if ( $type == 0 ) {
            $heading_text = $demure['header_text_heading'];
            $tagline = $demure['header_text_tagline'];

            if( !empty( $heading_text ) ) {
                $site_branding = '<h1><a href="' . site_url() . '">' . $heading_text . '</a></h1>';
            }

            if( !empty( $tagline ) ) {
                $site_description = '<span>' . $tagline . '</span>';
            }
            $out = '<div class="branding branding-text">';
                $out .= $site_branding;
                $out .= $site_description;
            $out .= '</div>';
        } else {
            $logotype = $demure['logotype'];
            if ( !empty( $logotype['url'] ) ) {
                $out = '<div class="branding branding-image">';
					$out .= '<div class="container-branding-image">';
	                    $out .= '<img src="' . $logotype['url'] . '" />';
	                    $out .= '<a class="logotype-link" href="' . home_url() . '"></a>';
					$out .= '</div>';
                $out .= '</div>';
            }
        }
        
        
        
        echo $out;
    }
}


// get post header 
if ( ! function_exists( 'demure_post_header' ) ) {
    function demure_post_header( $post_id = '' ) {
        global $post;
        $out_header = $page_title = $out = '';
        $page_title = rwmb_meta( 'page_title');
        
        if ( $page_title == 'off' ) {
			$out .= '<div class="empty-space-no-title"></div>';
			echo $out;
			return;
		}
        
        if (!is_single()) {
            $out_header .= '<h3><a href="' . get_the_permalink( $post_id ) . '">' . get_the_title( $post_id ) . '</a></h3>';
        } else {
            $out_header .= '<h1>' . get_the_title( $post_id ) . '</h1>';
        }
        $out = '<header class="entry-header">';
            $out .= $out_header;
        $out .= '</header><!-- .entry-header -->';
        
        echo $out;
    }
}

// get post content
if ( ! function_exists( 'demure_post_content' ) ) {
    function demure_post_content( $post_id = '' ) {
        $content = get_the_content( $post_id );
        if ( ( !is_front_page() && is_home() ) || ( is_home() ) || is_author() ) {
            $content = wp_trim_words( get_the_content( $post_id ), 55, '<a class="read_more" href="'. get_permalink( $post_id ) .'">'.esc_html__('Read More', 'demure').'</a>' );
        }
        
        $post_content = apply_filters( 'the_content', $content );
        
        $out = '<div class="entry-content">';
            $out .= $post_content;
            $out .= '<div class="clearfix"></div>';
        $out .= '</div><!-- .entry-content -->';
        
        echo $out;
    }
}

if ( ! function_exists( 'demure_post_thumbnail' ) ) {
    function demure_post_thumbnail( $post_id = '' ) {
        global $post;
        if ( !has_post_thumbnail( $post_id ) ) return false;
        $thumbnail_id = get_post_thumbnail_id( $post_id );
        if ( empty( $thumbnail_id ) ) return false;
        $thumbnail = wp_get_attachment_image_url( $thumbnail_id, 'full' );
        if ( is_single() || is_page() ) {
            $out = '<div class="thumbnail thumbnail-single">';
                $out .= '<img src="' . $thumbnail . '" />';
                $out .= '<div class="overlay"></div>';
            $out .= '</div>';
        } else {
            $out = '<a href="' . get_the_permalink( $post_id ) . '" class="thumbnail">';
                $out .= '<img src="' . $thumbnail . '" />';
                $out .= '<div class="overlay"></div>';
            $out .= '</a>';
        }
        
        
        echo $out;
    }
}

if ( ! function_exists( 'demure_post_footer' ) ) {
    function demure_post_footer( $post_id = '' ) {
        global $demure, $post;
        $out = '<footer class="entry-footer">';
            $out .= '<div class="author">';
                if ( isset( $demure['display_author'] ) && $demure['display_author'] == '1' ) {
                    $out .= '<span class="author_label">' . esc_html__( 'author', 'demure' ) . ':</span><a href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '"> ' . get_the_author() . '</a><span class="date">' . esc_html__( 'Posted ', 'demure' ) . get_the_date( null, $post_id ) . '</span>';
                }
                
                if ( isset( $demure['display_categories'] ) && $demure['display_categories'] == '1' ) {
                    $all_categories = get_the_category( $post->ID );
                    
                    if ( !empty( $all_categories ) ) {
                        $out .= '<div class="categories-list">';
                            $out .= '<span class="categories-title">' . esc_html__( 'categories: ', 'demure' ) . '</span>';
                            foreach ( $all_categories as $key => $cat ) {
                                $out .= '<a href="'.get_term_link( $cat->term_id ).'">' . $cat->name . '</a>';
                            }
                        $out .= '</div>';
                    }    
                }
                
                if ( isset( $demure['display_tags'] ) && $demure['display_tags'] == '1' ) {
                    $all_tags = get_the_tags( $post->ID );
                    
                    if ( !empty( $all_tags ) ) {
                        $out .= '<div class="tag-list">';
                            $out .= '<span class="tag-title">' . esc_html__( 'tags: ', 'demure' ) . '</span>';
                            foreach ( $all_tags as $key => $tag ) {
                                $out .= '<a href="'.get_term_link( $tag->term_id ).'">' . $tag->name . '</a>';
                            }
                        $out .= '</div>';
                    }    
                }
            $out .= '</div>';
            
        $out .= '</footer><!-- .entry-footer -->';
        
        echo $out;
    }
}

add_filter('comment_form_fields', 'demure_reorder_comment_fields' );
if ( ! function_exists( 'demure_reorder_comment_fields' ) ) {
    function demure_reorder_comment_fields( $fields ){

        $new_fields = array();

        $demure_order = array('author','email','comment', 'url');

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

function ajax_load_posts(){
    $args = unserialize(stripslashes($_POST['query']));
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';
    $q = new WP_Query($args);
    if( $q->have_posts() ):
        while($q->have_posts()): $q->the_post();
            get_template_part( 'template-parts/content', get_post_format() );
        endwhile;
    endif;
    wp_reset_postdata();
    die();
}
add_action('wp_ajax_loadposts', 'ajax_load_posts');
add_action('wp_ajax_nopriv_loadposts', 'ajax_load_posts');

if ( ! function_exists( 'demure_user_authenticate' ) ) {
    function demure_user_authenticate(){
        if ( !empty($_POST['form']) ) {
            parse_str($_POST['form'], $data);
            $user_data = array();
            $user_data['user_login'] = $data['user_login'];
            $user_data['user_password'] = $data['user_pass'];

            $auth = wp_signon( $user_data, false );

            if ( is_wp_error( $auth ) ) {
                $error_string = $auth->get_error_message();
                if ( !empty( $error_string ) ) {
                    $result = '<div class="notification notification-warning"><p>' . $error_string . '</p></div>';
                }
            } else {
                $result = '<div class="notification notification-success"><p>'.esc_html__( 'Success!','demure' ).'</p></div>';

            }

        }
        echo $result;
        die();
    }
}
add_action('wp_ajax_user_authenticate', 'demure_user_authenticate');
add_action('wp_ajax_nopriv_user_authenticate', 'demure_user_authenticate');

if ( ! function_exists( 'demure_user_registration' ) ) {
    function demure_user_registration(){
        $username = $password = $email = $first_name = $last_name = "";
        if ( !empty($_POST['form']) && !empty($_POST['action']) && $_POST['action'] == 'user_registration' ) {
            parse_str($_POST['form'], $data);
            
            $errors = new WP_Error;

            $username   =   sanitize_user( $data['username'] );
            $password   =   esc_attr( $data['password'] );
            $email      =   sanitize_email( $data['email'] );
            $first_name =   sanitize_text_field( $data['first_name'] );
            $last_name  =   sanitize_text_field( $data['last_name'] );

            if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
                $errors->add( 'missing_field', esc_html__( 'Required form field is missing', 'demure' ) );
            }

            if ( 4 > strlen( $username ) ) {
                $errors->add( 'username_length', esc_html__( 'Username too short. At least 4 characters is required', 'demure' ) );
            }
            
            if ( $username != sanitize_key( $username ) ) {
                $errors->add( 'invalid_username', esc_html__( 'Username contains invalid characters.', 'demure' ) );
            }

            if ( username_exists( $username ) ) {
                $errors->add( 'user_name', esc_html__( 'Sorry, that username already exists!', 'demure' ) );
            }

            if ( ! validate_username( $username ) ) {
                $errors->add( 'username_invalid', esc_html__( 'Sorry, the username you entered is not valid', 'demure' ) );
            }

            if ( 5 > strlen( $password ) ) {
                $errors->add( 'password', esc_html__( 'Password length must be greater than 5', 'demure' ) );
            }

            if ( !is_email( $email ) ) {
                $errors->add( 'email_invalid', esc_html__( 'Email is not valid', 'demure' ) );
            }

            if ( email_exists( $email ) ) {
                $errors->add( 'email_use', esc_html__( 'Email Already in use', 'demure' ) );
            }
            
            $userdata = array(
                'user_login'    =>   $username,
                'user_email'    =>   $email,
                'user_pass'     =>   $password,
                'first_name'    =>   $first_name,
                'last_name'     =>   $last_name,
            );
            
            $error_string = $errors->get_error_message();

            if( empty( $error_string ) ) {
                $user_id = wp_insert_user( $userdata );
                $result = '<div class="notification notification-success"><p>'.esc_html__( 'Success!','demure' ).'</p></div>';
            } else {
                
                if ( !empty( $error_string ) ) {
                    $result = '<div class="notification notification-warning"><p>' . $error_string . '</p></div>';
                }
            } 

            
        }
        echo $result;
        die();
    }
}

add_action('wp_ajax_user_registration', 'demure_user_registration');
add_action('wp_ajax_nopriv_user_registration', 'demure_user_registration');

if ( ! function_exists( 'get_homepage_slider' ) ) {
    function get_homepage_slider(){
        global $demure;
        if ( ( !empty( $demure['switch_slider'] ) && $demure['switch_slider']  == '1' ) && ( !is_home() && is_front_page() ) ) {

            $slides = $demure['home_slider'];
            ?>
            <div class="homepage-slider-wrapper">
                <div class="homepage-slider owl-carousel">
                    <?php foreach ($slides as $key => $slide): ?>
                        <div class="slide">
                            <?php if ( !empty( $slide['title'] ) || !empty( $slide['description'] ) ): ?>
                                <div class="slide-information">
                                    <?php if ( !empty( $slide['title'] ) ): ?>
                                        <h3><?php echo $slide['title']; ?></h3>
                                    <?php endif ?>
                                    <?php if ( !empty( $slide['description'] ) ): ?>
                                        <div class="description"><?php echo $slide['description']; ?></div>
                                    <?php endif ?>   
                                </div>
                               
                                
                            <?php endif ?>
                            
                            
                            <img data-src="holder.js/1980x1080?text=image" src="<?php echo $slide['image']; ?>" alt="">
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

if ( ! function_exists( 'get_all_user_posts' ) ) {
    function get_all_user_posts() {
        global $demure;
        wp_reset_postdata();
        if ( have_posts() ) {
            
            ?>
            <h3 class="heading"><?php esc_html_e( 'Posts:', 'demure' ); ?></h3>
            <?php

            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', get_post_format() );
            endwhile;

            if ( $demure['post_navigation'] == '2' || $demure['post_navigation'] == '3' ) {
                global $wp_query;
                if (  $wp_query->max_num_pages > 1 ) : ?>
                    <script id="true_loadmore">
                    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                    var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
                    var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                    var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
                    </script>
                    <?php if ( $demure['post_navigation'] == '2' ) { ?>
                        <div id="loadmore">
                            <span data-loading="<?php esc_html_e( 'Loading ...', 'demure' ); ?>" data-load-more="<?php esc_html_e( 'Load More', 'demure' ); ?>" class="button"><?php esc_html_e( 'Load More', 'demure' ); ?></span>
                        </div>
                    <?php } ?>
                <?php endif;
            } elseif ( $demure['post_navigation'] == '1' ) {
                the_posts_pagination( array( 'screen_reader_text' => ' ' ) );
            }

        } else {

            get_template_part( 'template-parts/content', 'none' );

        }
    }
}

if ( ! function_exists( 'get_author_info' ) ) {
    function get_author_info() {
        if ( is_user_logged_in() ) {
            $user_id = get_current_user_id();
            $user_info = get_userdata( $user_id );
            
            $user_email = $user_info->data->user_email;
            $user_url = $user_info->data->user_url;
            $display_name = $user_info->data->display_name;
            ?>
                <div class="user-info">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nickname"><?php esc_html_e( 'Nickname', 'demure' ); ?></label>
                            <input type="text" id="nickname" name="nickname" required value="<?php echo $display_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="firstname"><?php esc_html_e( 'First Name', 'demure' ); ?></label>
                            <input type="text" id="firstname" name="firstname" value="<?php echo get_user_meta( $user_id, 'first_name', true ); ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname"><?php esc_html_e( 'Last Name', 'demure' ); ?></label>
                            <input type="text" id="lastname" name="lastname" value="<?php echo get_user_meta( $user_id, 'last_name', true ); ?>">
                        </div>
                        <div class="form-group">
                            <label for="email"><?php esc_html_e( 'Email', 'demure' ); ?></label>
                            <input type="email" id="email" name="email" value="<?php echo $user_email; ?>">
                        </div>
                        <div class="form-group">
                            <label for="website"><?php esc_html_e( 'Website', 'demure' ); ?></label>
                            <input type="url" id="website" name="website" value="<?php echo $user_url; ?>">
                        </div>
                        <div class="form-group">
                            <label for="biographical"><?php esc_html_e( 'Biographical Info', 'demure' ); ?></label>
                            <textarea id="biographical" name="biographical" rows="8" cols="80"><?php echo get_user_meta( $user_id, 'description', true ); ?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update_user_info" value="<?php esc_html_e( 'Save changes', 'demure' ); ?>" />
                        </div>
                    </form>
                </div>
        <?php } else { 
            $user_id = get_the_author_meta('ID');
            $user_info = get_userdata( $user_id );
            
            $user_email = $user_info->data->user_email;
            $user_url = $user_info->data->user_url;
            $display_name = $user_info->data->display_name;
            $firstname = get_user_meta( $user_id, 'first_name', true );
            $lastname = get_user_meta( $user_id, 'last_name', true );
            $bio = get_user_meta( $user_id, 'description', true );
            ?>
            <div class="user-info">
                <div class="profile-page-block">
                    <h3 class="heading"><?php esc_html_e( 'Author information', 'demure' ); ?></h3>
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="container-dl">
                                <?php if ( !empty( $display_name ) ): ?>
                                    <div>
                                        <dt><?php esc_html_e( 'Nickname:', 'demure' ); ?></dt>
                                        <dd><?php echo $display_name; ?></dd>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ( !empty( $firstname ) ): ?>
                                    <div>
                                        <dt><?php esc_html_e( 'First name:', 'demure' ); ?></dt>
                                        <dd><?php echo $firstname; ?></dd>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ( !empty( $lastname ) ): ?>
                                    <div>
                                        <dt><?php esc_html_e( 'Last Name:', 'demure' ); ?></dt>
                                        <dd><?php echo $lastname; ?></dd>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ( !empty( $user_email ) ): ?>
                                    <div>
                                        <dt><?php esc_html_e( 'Email:', 'demure' ); ?></dt>
                                        <dd><a href="mailto:<?php echo $user_email; ?>"><?php echo $user_email; ?></a></dd>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ( !empty( $user_url ) ): ?>
                                    <div>
                                        <dt><?php esc_html_e( 'Website:', 'demure' ); ?></dt>
                                        <dd><a href="<?php echo $user_url; ?>"><?php echo $user_url; ?></a></dd>
                                    </div>
                                <?php endif; ?>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl>
                                <?php if ( !empty( $bio ) ): ?>
                                    <dt><?php esc_html_e( 'About Me', 'demure' ); ?></dt>
                                    <dd><?php echo $bio; ?></dd>
                                <?php endif; ?>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }
}

if ( ! function_exists( 'demure_preloader' ) ) {
    function demure_preloader() {
        global $demure;
        if ( !empty($demure['preloader']) && $demure['preloader'] == '1' ) {
            $out = '<div class="demure-preloader"></div>';
            echo $out;
        }
    }
}

add_filter( 'get_avatar' , 'custom_demure_avatar' , 1 , 5 );
if ( ! function_exists( 'custom_demure_avatar' ) ) {
    function custom_demure_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
        $user_id = $id_or_email;
        $user_avatar = get_user_meta( $user_id, 'demure_avatar', true );

        if ( ! empty( $user_avatar ) ) {
            $avatar = "<img alt='{$alt}' src='{$user_avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
        }

        return $avatar;
    }
}

if ( ! function_exists( 'demure_user_avatar' ) ) {
    function demure_user_avatar() {
        global $post;
        $author = get_user_by( 'slug', get_query_var( 'author_name' ) );
        $user_id = $author->data->ID;
        $user_avatar = get_avatar( $user_id, 228 );
        ?>
        <div class="profile-avatar">
            <form name="update_user_avatar" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post">
                <div class="profile-avatar-src">
                    <?php echo $user_avatar; ?>
                </div>
                
                <?php if ( is_user_logged_in() ): ?>
                    <div class="button-container">
						<div class="input-file-container">
							<label class="button" for="avatar"><?php esc_html_e( 'Upload', 'demure' ); ?></label>
                        	<input type="file" accept='image/*' id="avatar" class="fileupload button" name="user_avatar" data-jfiler-limit="1" value="" />
                        </div>
						<input type="button" name="remove_profile_avatar" class="button delete-demure-avatar" value="<?php esc_html_e( 'Remove', 'demure' ); ?>">
                    </div>
                <?php endif; ?>
            </form>
        </div>
        <?php
    }
}

if ( ! function_exists( 'demure_update_avatar' ) ) {
    function demure_update_avatar(){
		$error = '';
        if ( $_POST['action'] == 'demure_update_avatar' ) {
            if ( !empty( $_FILES['avatar'] ) ) {
                $file_arr = wp_handle_upload( $_FILES['avatar'], array( 'test_form' => FALSE ) );
				if ( $_FILES['avatar']['type'] != "image/jpeg" && $_FILES['avatar']['type'] != "image/png" ) {
					$error = 1;
				} elseif ( $_FILES['avatar']['size'] > 2000000 ) {
					$error = 2;
				} else {
					$file_arr = wp_handle_upload( $_FILES['avatar'], array( 'test_form' => FALSE ) );
					update_user_meta( get_current_user_id(), 'demure_avatar', $file_arr['url'] );
					$error = 0;
				}

				echo json_encode( $error );
            }
        }
        die();
    }
}
add_action('wp_ajax_demure_update_avatar', 'demure_update_avatar');
add_action('wp_ajax_nopriv_demure_update_avatar', 'demure_update_avatar');

if ( ! function_exists( 'demure_delete_avatar' ) ) {
    function demure_delete_avatar(){
        if ( $_POST['action'] == 'demure_delete_avatar' ) {
            delete_user_meta( get_current_user_id(), 'demure_avatar' );
            echo json_encode( esc_html__( 'Avatar removed', 'demure' ) );
        }
        die();
    }
}
add_action('wp_ajax_demure_delete_avatar', 'demure_delete_avatar');
add_action('wp_ajax_nopriv_demure_delete_avatar', 'demure_delete_avatar');

if ( !empty( $_POST['update_user_info'] ) ) {
    $user_id = get_current_user_id();
    
    $name = sanitize_text_field( $_POST['nickname'] );
    $firstname = sanitize_text_field( $_POST['firstname'] );
    $lastname = sanitize_text_field( $_POST['lastname'] );
    $email = sanitize_email( $_POST['email'] ); 
    $website = esc_url( $_POST['website'] ); 
    $biographical = esc_textarea( $_POST['biographical'] );
    
    wp_update_user( array( 
        'ID' => $user_id, 
        'user_email' => $email,
        'user_url' => $website,
        'display_name' => $name
    ) );
    
    if ( !empty( $firstname ) ) update_user_meta( $user_id, 'first_name', $firstname );
    if ( !empty( $lastname ) ) update_user_meta( $user_id, 'last_name', $lastname );
    if ( !empty( $biographical ) ) update_user_meta( $user_id, 'description', $biographical );
    
    wp_redirect( $_SERVER['REQUEST_URI'] );
    exit;
}

if ( ! function_exists( 'footer_text' ) ) {
    function footer_text() {
        global $demure;
        if ( empty( $demure['footer-text'] ) ) return false;
        $out = '';
        $allowed_tags = wp_kses_allowed_html( 'post' );
		$out .= '<div class="site-info-text">';
        	$out .= wp_kses( stripslashes( $demure['footer-text'] ), $allowed_tags );
		$out .= '</div>';
        echo $out;
    }
}

if ( ! function_exists( 'get_demure_comment' ) ) {
	function get_demure_comment( $comment, $args, $depth ) {
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
			$out .= '<div class="'.implode(' ', $comment_class ).'">';
				$out .= '<div class="comment-wrap">';
					$out .= '<div class="comment-author-block">';
						$out .= '<div class="comment-author-avatar">'. get_avatar( $comment->user_id ) . '</div>';
					$out .= '</div>';
					$out .= '<div class="comment-content-block">';
						$out .= '<div class="comment-header">';
								$out .= '<div class="comment-author">' . $author . '</div>';
							$out .= '<div class="date">' . $date . '</div>';
						$out .= '</div>';
						$out .= '<div class="comment">' . $comment_content . '</div>';
						$out .= '<div class="comment-footer">'.get_comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('Reply', 'demure')))).'</div>';

					$out .= '</div>';
				$out .= '</div>';
			
			echo $out;
		}
		
	}
}

if ( ! function_exists( 'get_footer_columns' ) ) {
	function get_footer_columns() {
		global $demure;
		$columns = 4;
		if ( ! empty( $demure['footer-columns'] ) ) $columns = $demure['footer-columns'];
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
if ( ! function_exists( 'get_demure_social' ) ) {
	function get_demure_social() {
		global $demure;
		$out = '';
		$out .= '<div class="social-links-wrapper">';
			if ( !empty( $demure['facebook'] ) ) $out .= '<a href="'.esc_url( $demure['facebook'] ).'" target="_blank" class="demure-icon"><i class="fa fa-facebook"></i></a>';
			if ( !empty( $demure['twitter'] ) ) $out .= '<a href="'.esc_url( $demure['twitter'] ).'" target="_blank" class="demure-icon"><i class="fa fa-twitter"></i></a>';
			if ( !empty( $demure['vkontakte'] ) ) $out .= '<a href="'.esc_url( $demure['vkontakte'] ).'" target="_blank" class="demure-icon"><i class="fa fa-vk"></i></a>';
			if ( !empty( $demure['linkedin'] ) ) $out .= '<a href="'.esc_url( $demure['linkedin'] ).'" target="_blank" class="demure-icon"><i class="fa fa-linkedin"></i></a>';
			if ( !empty( $demure['pinterest'] ) ) $out .= '<a href="'.esc_url( $demure['pinterest'] ).'" target="_blank" class="demure-icon"><i class="fa fa-pinterest"></i></a>';
			if ( !empty( $demure['youtube'] ) ) $out .= '<a href="'.esc_url( $demure['youtube'] ).'" target="_blank" class="demure-icon"><i class="fa fa-youtube"></i></a>';
			if ( !empty( $demure['instagram'] ) ) $out .= '<a href="'.esc_url( $demure['instagram'] ).'" target="_blank" class="demure-icon"><i class="fa fa-instagram"></i></a>';
			if ( !empty( $demure['googleplus'] ) ) $out .= '<a href="'.esc_url( $demure['googleplus'] ).'" target="_blank" class="demure-icon"><i class="fa fa-google-plus"></i></a>';
			if ( !empty( $demure['behance'] ) ) $out .= '<a href="'.esc_url( $demure['behance'] ).'" target="_blank" class="demure-icon"><i class="fa fa-behance"></i></a>';
			if ( !empty( $demure['flickr'] ) ) $out .= '<a href="'.esc_url( $demure['flickr'] ).'" target="_blank" class="demure-icon"><i class="fa fa-flickr"></i></a>';
			if ( !empty( $demure['skype'] ) ) $out .= '<a href="call:'.sanitize_text_field( $demure['skype'] ).'" target="_blank" class="demure-icon"><i class="fa fa-skype"></i></a>';
			if ( !empty( $demure['dribble'] ) ) $out .= '<a href="'.esc_url( $demure['dribble'] ).'" target="_blank" class="demure-icon"><i class="fa fa-dribble"></i></a>';
			if ( !empty( $demure['email'] ) ) $out .= '<a href="mailto:'.sanitize_email( $demure['email'] ).'" target="_blank" class="demure-icon"><i class="fa fa-facebook"></i></a>';
		$out .= '</div>';
		
		echo $out;
	}
}

if ( ! function_exists( 'anaglyph_add_favicon' ) ) {				
	function anaglyph_add_favicon() {
		global $demure;
		
		if( !empty($demure['favicon'])) 				echo '<link rel="shortcut icon" href="' .  	esc_url($demure['favicon']['url'])  . '"/>' . "\n";
		if( !empty($demure['favicon-iphone'])) 			echo '<link rel="apple-touch-icon" href="'. esc_url($demure['favicon-iphone']['url']) .'"> '. "\n"; 
		if( !empty($demure['favicon-iphone-retina'])) 	echo '<link rel="apple-touch-icon" sizes="114x114" 	href="'.  esc_url($demure['favicon-iphone-retina']['url']) .' "> '. "\n"; 
		if( !empty($demure['favicon-ipad'])) 			echo '<link rel="apple-touch-icon" sizes="72x72" 	href="'. esc_url($demure['favicon-ipad']['url']) .'"> '. "\n"; 
		if( !empty($demure['favicon-ipad-retina']))		echo '<link rel="apple-touch-icon" sizes="144x144" 	href="'. esc_url($demure['favicon-ipad-retina']['url'])  .'"> '. "\n";  
	 
	}
	add_action('wp_head', 'anaglyph_add_favicon', 100);
}
