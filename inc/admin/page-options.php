<?php

if ( is_admin() ) {
    add_action( 'add_meta_boxes', 'demure_add_metabox' );
	add_action( 'save_post', 'demure_save_metabox' );
}

function demure_add_metabox( $post_type ) {
    $post_types = array('post','page');
    
    if ( in_array( $post_type, $post_types ) ) {
		add_meta_box(
			'demure_page_metabox'
			,esc_html__( 'Options', 'meteorite' )
			,'demure_render_meta_box_content'
			,$post_type
			,'advanced'
			,'high'
		);
	}
    
}

function demure_save_metabox( $post_id ) {
    
    if ( ! isset( $_POST['demure_inner_custom_box_nonce'] ) )
			return $post_id;
            
    $nonce = $_POST['demure_inner_custom_box_nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'demure_inner_custom_box' ) )
        return $post_id;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return $post_id;
        
    if ( 'page' == $_POST['post_type'] || 'post' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	}
    
	$demure_page_title 		= isset( $_POST['demure_page_title'] ) ? esc_attr( $_POST['demure_page_title'] ) : false;
	$demure_page_layout 	= isset( $_POST['demure_page_layout'] ) ? esc_attr( $_POST['demure_page_layout'] ) : false;

	update_post_meta( $post_id, 'demure_page_title', $demure_page_title );
	update_post_meta( $post_id, 'demure_page_layout', $demure_page_layout );
}

function demure_render_meta_box_content( $post ) {
    wp_nonce_field( 'demure_inner_custom_box', 'demure_inner_custom_box_nonce' );
    
    $demure_page_title = get_post_meta( $post->ID, 'demure_page_title', true );
    $demure_page_layout = get_post_meta( $post->ID, 'demure_page_layout', true );
    
    ?>
    <div class="demure-meta-wrapper">
        <div class="demure-meta-section">
            <div class="demure-field-description">
                <h4><?php esc_html_e( 'Show title', 'demure' ); ?></h4>
            </div>
            <div class="demure-field-content demure-switch-field-content">
                <div class="demure-switcher">
                    <input id="demure-page-title-on" type="radio" name="demure_page_title" <?php echo ( $demure_page_title == false || $demure_page_title == 'on' ? 'checked="checked"' : '' ); ?> value="on">
                    <label for="demure-page-title-on"><?php esc_html_e( 'Yes', 'demure' ); ?></label>
                </div>
                <div class="demure-switcher">
                    <input id="demure-page-title-off" type="radio" name="demure_page_title" <?php echo ( $demure_page_title == 'off' ? 'checked="checked"' : '' ); ?> value="off">
                    <label for="demure-page-title-off"><?php esc_html_e( 'No', 'demure' ); ?></label>
                </div>
            </div>
        </div>
        <div class="demure-meta-section">
            <div class="demure-field-description">
                <h4><?php esc_html_e( 'Page layout', 'demure' ); ?></h4>
            </div>
            <div class="demure-field-content demure-image-radio-field-content">
                <div class="demure-image-switcher">
                    <input id="demure-page-layout-1" type="radio" name="demure_page_layout" <?php echo ( $demure_page_layout == 1 ? 'checked="checked"' : '' ); ?> value="1">
                    <label for="demure-page-layout-1"><img src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/img/1col.png' ); ?>"/></label>
                </div>
                <div class="demure-image-switcher">
                    <input id="demure-page-layout-2" type="radio" name="demure_page_layout" <?php echo ( $demure_page_layout == 2 ? 'checked="checked"' : '' ); ?> value="2">
                    <label for="demure-page-layout-2"><img src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/img/2cl.png' ); ?>"/></label>
                </div>
                <div class="demure-image-switcher">
                    <input id="demure-page-layout-3" type="radio" name="demure_page_layout" <?php echo ( $demure_page_layout == 3 ? 'checked="checked"' : '' ); ?> value="3">
                    <label for="demure-page-layout-3"><img src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/img/2cr.png' ); ?>"/></label>
                </div>
                <div class="demure-image-switcher">
                    <input id="demure-page-layout-4" type="radio" name="demure_page_layout" <?php echo ( $demure_page_layout == 4 ? 'checked="checked"' : '' ); ?> value="4">
                    <label for="demure-page-layout-4"><img src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/img/3cm.png' ); ?>"/></label>
                </div>
                <div class="demure-image-switcher">
                    <input id="demure-page-layout-5" type="radio" name="demure_page_layout" <?php echo ( $demure_page_layout == 5 ? 'checked="checked"' : '' ); ?> value="5">
                    <label for="demure-page-layout-5"><img src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/img/3cl.png' ); ?>"/></label>
                </div>
                <div class="demure-image-switcher">
                    <input id="demure-page-layout-6" type="radio" name="demure_page_layout" <?php echo ( $demure_page_layout == 6 ? 'checked="checked"' : '' ); ?> value="6">
                    <label for="demure-page-layout-6"><img src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/img/3cr.png' ); ?>"/></label>
                </div>
            </div>
        </div>
    </div>
    <?php
}