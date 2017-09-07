<?php
/**
* The template for displaying comments.
*
* This is the template that displays the area of the page that contains both the current comments
* and the comment form.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package demure
*/

/*
* If the current post is protected by a password and
* the visitor has not yet entered the password we will
* return early without loading the comments.
*/
global $demure_config, $post;
$post_type = get_post_type( $post->ID );
if ( post_password_required() ) {
    return;
}

( '' != $demure_config['display-comments'] ? $display = $demure_config['display-comments'] : $display = 4 );
if ( $display == 1 || ( $display == 2 && $post_type != 'post' ) || ( $display == 3 && ( $post_type != 'page' && $post_type != 'post' ) )  ) return;

?>

<div id="comments" class="comments-area">
    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) : ?>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
        <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'demure' ); ?></h2>
            <div class="nav-links">
                <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'demure' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'demure' ) ); ?></div>
                
            </div><!-- .nav-links -->
        </nav><!-- #comment-nav-above -->
    <?php endif; // Check for comment navigation. ?>
    
    <div class="comment-list">
        <?php
        $args = array(
            'status' 	  => 'approve',
            'post_id'     => $post->ID
        );
        
        // The comment Query
        $comments = get_comments( $args );
        
        // Comment Loop
        ?><div class="comments-container">
            <?php
            wp_list_comments(
                array(
                    'style' => 'div',
                    'callback' => 'demure_get_comment'
                )
            );
            ?>
        </div>
        
    </div><!-- .comment-list -->
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
        <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'demure' ); ?></h2>
            <div class="nav-links">
                
                <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'demure' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'demure' ) ); ?></div>
                
            </div><!-- .nav-links -->
        </nav><!-- #comment-nav-below -->
        <?php
    endif; // Check for comment navigation.
    
endif; // Check for have_comments().


// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'demure' ); ?></p>
<?php
endif;

$comment_args = array();

comment_form( $comment_args, $post->ID );
?>

</div><!-- #comments -->
