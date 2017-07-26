<?php 
add_filter( 'rwmb_meta_boxes', 'demure_meta_boxes' );
function demure_meta_boxes( $meta_boxes ) {
    $meta_boxes['page_options'] = array(
        'id'         => 'demure-page-metaboxes',
        'title'      => esc_html__( 'Page options', 'demure' ),
        'post_types' => 'page',
        'fields'     => array(
            array(
                'id'      => 'page_title',
                'name'    => esc_html__( 'Show title', 'demure' ),
                'type'    => 'radio',
                'options' => array(
                    'on'  => esc_html__( 'Yes', 'demure' ),
                    'off' => esc_html__( 'No', 'demure' ),
                ),
                'std' => 'on'
            ),
            array(
                'id'        => 'page_layout',
                'name'      => esc_html__( 'Page layout', 'demure' ),
                'type'      => 'image_select',
                'class'     => 'select-admin-container',
                'options'   => array(
                    '1'     => get_template_directory_uri() . '/inc/admin/img/1col.png',
                    '2'     => get_template_directory_uri() . '/inc/admin/img/2cl.png',
                    '3'     => get_template_directory_uri() . '/inc/admin/img/2cr.png',
                    '4'     => get_template_directory_uri() . '/inc/admin/img/3cm.png',
                    '5'     => get_template_directory_uri() . '/inc/admin/img/3cl.png',
                    '6'     => get_template_directory_uri() . '/inc/admin/img/3cr.png',
                ),
                'std' => 'default'
            ),
        ),
    );
    return $meta_boxes;
}